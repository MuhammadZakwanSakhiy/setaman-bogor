<?php

use App\Models\User;
use App\Models\Product;
use App\Models\Article;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('page tentang shows correct counts of products and articles', function () {
    // Create a category
    $cat = Category::create(['name' => 'Tanaman Indoor', 'description' => 'Test']);

    // Create 3 active products (2 active, 1 inactive)
    Product::create([
        'name' => 'Monstera',
        'category_id' => $cat->id,
        'price' => 100000,
        'stock' => 10,
        'description' => 'Test',
        'is_active' => true,
        'slug' => 'monstera',
    ]);
    Product::create([
        'name' => 'Snake Plant',
        'category_id' => $cat->id,
        'price' => 100000,
        'stock' => 10,
        'description' => 'Test',
        'is_active' => true,
        'slug' => 'snake-plant',
    ]);
    Product::create([
        'name' => 'Inactive Plant',
        'category_id' => $cat->id,
        'price' => 100000,
        'stock' => 10,
        'description' => 'Test',
        'is_active' => false,
        'slug' => 'inactive-plant',
    ]);

    // Create a user for article author
    $user = User::factory()->create();

    // Create 2 articles (1 published, 1 draft)
    Article::create([
        'title' => 'Article 1',
        'slug' => 'article-1',
        'content' => 'Test',
        'is_published' => true,
        'author_id' => $user->id,
    ]);
    Article::create([
        'title' => 'Article 2',
        'slug' => 'article-2',
        'content' => 'Test',
        'is_published' => false,
        'author_id' => $user->id,
    ]);

    $response = $this->get('/tentang');
    $response->assertStatus(200);
    $response->assertViewHas('activeProductsCount', 2);
    $response->assertViewHas('activeArticlesCount', 1);
});

test('catalog page displays products and compact JSON data', function () {
    $cat = Category::create(['name' => 'Indoor', 'description' => 'Test']);
    Product::create([
        'name' => 'Mawar Merah',
        'category_id' => $cat->id,
        'price' => 50000,
        'stock' => 10,
        'description' => 'Cantik',
        'is_active' => true,
        'slug' => 'mawar-merah',
    ]);

    $response = $this->get('/katalog');
    $response->assertStatus(200);
    $response->assertViewHas('allProductsJson');
});

test('admin dashboard loads correctly with sales data', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $response = $this->actingAs($admin)->get('/admin/dashboard');
    $response->assertStatus(200);
    $response->assertViewHas('salesPerMonth');
    $response->assertViewHas('weeklySales');
});

test('article search filters articles based on query', function () {
    $cat = Category::create(['name' => 'Kategori Baru', 'description' => 'Test']);
    $user = User::factory()->create();

    Article::create([
        'title' => 'Cara Merawat Aglonema',
        'slug' => 'cara-merawat-aglonema',
        'content' => 'Gunakan pupuk organik secara teratur.',
        'is_published' => true,
        'author_id' => $user->id,
    ]);

    Article::create([
        'title' => 'Mengenal Lidah Mertua',
        'slug' => 'mengenal-lidah-mertua',
        'content' => 'Tanaman hias indoor yang tangguh.',
        'is_published' => true,
        'author_id' => $user->id,
    ]);

    // Search for "Aglonema"
    $response = $this->get('/artikel?search=Aglonema');
    $response->assertStatus(200);
    $response->assertSee('Cara Merawat Aglonema');
    $response->assertDontSee('Mengenal Lidah Mertua');

    // Search for "Indoor"
    $response = $this->get('/artikel?search=indoor');
    $response->assertStatus(200);
    $response->assertSee('Mengenal Lidah Mertua');
    $response->assertDontSee('Cara Merawat Aglonema');
});

test('newsletter subscription sends log mail and records user activity', function () {
    \Illuminate\Support\Facades\Mail::shouldReceive('raw')
        ->once()
        ->with(
            \Mockery::on(function ($text) {
                return str_contains($text, 'Terima kasih telah berlangganan newsletter Setaman Bogor');
            }),
            \Mockery::on(function ($callback) {
                $message = Mockery::mock(\Illuminate\Mail\Message::class);
                $message->shouldReceive('to')
                    ->with('subscriber@test.com')
                    ->andReturnSelf();
                $message->shouldReceive('subject')
                    ->with('Terima Kasih Telah Berlangganan Newsletter Setaman Bogor')
                    ->andReturnSelf();
                $callback($message);
                return true;
            })
        );

    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/subscribe', [
        'email' => 'subscriber@test.com',
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('success_subscription');

    // Assert activity log is written
    $this->assertDatabaseHas('user_activities', [
        'user_id' => $user->id,
        'activity' => 'Berlangganan buletin/newsletter email',
    ]);
});

test('whatsapp country code prefix normalization works on register and profile update', function () {
    // 1. Registration
    $response = $this->post('/registrasi', [
        'name' => 'Test User WA',
        'email' => 'wa@test.com',
        'country_code' => '+62',
        'phone' => '08123456789',
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ]);

    $response->assertRedirect('/');

    $user = User::where('email', 'wa@test.com')->first();
    expect($user->phone)->toBe('+628123456789');

    // Assert profile and registration activity exist
    $this->assertDatabaseHas('user_profiles', ['user_id' => $user->id]);
    $this->assertDatabaseHas('user_activities', [
        'user_id' => $user->id,
        'activity' => 'Mendaftar akun baru',
    ]);

    // 2. Profile Update
    $response = $this->actingAs($user)->post('/profil', [
        'name' => 'Updated User WA',
        'country_code' => '+60',
        'phone' => '855667788',
    ]);

    $user->refresh();
    expect($user->name)->toBe('Updated User WA');
    expect($user->phone)->toBe('+60855667788');
    $this->assertDatabaseHas('user_activities', [
        'user_id' => $user->id,
        'activity' => 'Memperbarui profil pengguna',
    ]);
});

test('profile avatar upload changes user profile image url', function () {
    \Illuminate\Support\Facades\Storage::fake('public');

    $user = User::factory()->create();
    $profile = $user->profile()->create();

    $file = \Illuminate\Http\UploadedFile::fake()->image('avatar.jpg');

    $response = $this->actingAs($user)->post('/profil', [
        'name' => $user->name,
        'avatar' => $file,
    ]);

    $response->assertRedirect();
    
    $profile->refresh();
    expect($profile->avatar_url)->not->toBeNull();
    \Illuminate\Support\Facades\Storage::disk('public')->assertExists($profile->avatar_url);
});
