CREATE DATABASE setaman_bogor;

BEGIN;

CREATE TABLE users (
    id BIGSERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password TEXT NOT NULL,
    role VARCHAR(20) NOT NULL DEFAULT 'user'
        CHECK (role IN ('user', 'admin')),
    phone VARCHAR(20),
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE user_profiles (
    id BIGSERIAL PRIMARY KEY,
    user_id BIGINT NOT NULL UNIQUE
        REFERENCES users(id) ON DELETE CASCADE,
    avatar_url TEXT,
    bio TEXT,
    address TEXT,
    is_public BOOLEAN NOT NULL DEFAULT TRUE,
    email_notifications BOOLEAN NOT NULL DEFAULT TRUE,
    dark_mode BOOLEAN NOT NULL DEFAULT FALSE,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE user_activities (
    id BIGSERIAL PRIMARY KEY,
    user_id BIGINT
        REFERENCES users(id) ON DELETE CASCADE,
    activity TEXT NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE categories (
    id BIGSERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE,
    description TEXT,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE products (
    id BIGSERIAL PRIMARY KEY,
    category_id BIGINT
        REFERENCES categories(id) ON DELETE SET NULL,
    name VARCHAR(150) NOT NULL,
    slug VARCHAR(180) NOT NULL UNIQUE,
    description TEXT,
    care_tips TEXT,
    price NUMERIC(12, 2) NOT NULL CHECK (price >= 0),
    stock INTEGER NOT NULL DEFAULT 0 CHECK (stock >= 0),
    image_url TEXT,
    is_best_seller BOOLEAN NOT NULL DEFAULT FALSE,
    is_active BOOLEAN NOT NULL DEFAULT TRUE,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE product_images (
    id BIGSERIAL PRIMARY KEY,
    product_id BIGINT NOT NULL
        REFERENCES products(id) ON DELETE CASCADE,
    image_url TEXT NOT NULL,
    sort_order INTEGER NOT NULL DEFAULT 0,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE wishlists (
    id BIGSERIAL PRIMARY KEY,
    user_id BIGINT NOT NULL UNIQUE
        REFERENCES users(id) ON DELETE CASCADE,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE wishlist_items (
    id BIGSERIAL PRIMARY KEY,
    wishlist_id BIGINT NOT NULL
        REFERENCES wishlists(id) ON DELETE CASCADE,
    product_id BIGINT NOT NULL
        REFERENCES products(id) ON DELETE CASCADE,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    UNIQUE (wishlist_id, product_id)
);

CREATE TABLE carts (
    id BIGSERIAL PRIMARY KEY,
    user_id BIGINT NOT NULL UNIQUE
        REFERENCES users(id) ON DELETE CASCADE,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE cart_items (
    id BIGSERIAL PRIMARY KEY,
    cart_id BIGINT NOT NULL
        REFERENCES carts(id) ON DELETE CASCADE,
    product_id BIGINT NOT NULL
        REFERENCES products(id) ON DELETE CASCADE,
    quantity INTEGER NOT NULL CHECK (quantity > 0),
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    UNIQUE (cart_id, product_id)
);

CREATE TABLE shipping_methods (
    id BIGSERIAL PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE,
    cost NUMERIC(10, 2) NOT NULL DEFAULT 0 CHECK (cost >= 0),
    description TEXT,
    is_active BOOLEAN NOT NULL DEFAULT TRUE,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE orders (
    id BIGSERIAL PRIMARY KEY,
    user_id BIGINT
        REFERENCES users(id) ON DELETE SET NULL,
    shipping_method_id BIGINT
        REFERENCES shipping_methods(id) ON DELETE SET NULL,
    order_code VARCHAR(30) NOT NULL UNIQUE,
    status VARCHAR(20) NOT NULL DEFAULT 'pending'
        CHECK (status IN ('pending', 'diproses', 'dikirim', 'selesai', 'dibatalkan')),
    customer_name VARCHAR(100) NOT NULL,
    customer_phone VARCHAR(20) NOT NULL,
    customer_address TEXT NOT NULL,
    note TEXT,
    subtotal_price NUMERIC(12, 2) NOT NULL DEFAULT 0 CHECK (subtotal_price >= 0),
    shipping_cost NUMERIC(10, 2) NOT NULL DEFAULT 0 CHECK (shipping_cost >= 0),
    total_price NUMERIC(12, 2) NOT NULL DEFAULT 0 CHECK (total_price >= 0),
    whatsapp_message TEXT,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE order_items (
    id BIGSERIAL PRIMARY KEY,
    order_id BIGINT NOT NULL
        REFERENCES orders(id) ON DELETE CASCADE,
    product_id BIGINT
        REFERENCES products(id) ON DELETE SET NULL,
    product_name VARCHAR(150) NOT NULL,
    quantity INTEGER NOT NULL CHECK (quantity > 0),
    price NUMERIC(12, 2) NOT NULL CHECK (price >= 0),
    subtotal NUMERIC(12, 2) NOT NULL CHECK (subtotal >= 0),
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE article_categories (
    id BIGSERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE articles (
    id BIGSERIAL PRIMARY KEY,
    category_id BIGINT
        REFERENCES article_categories(id) ON DELETE SET NULL,
    author_id BIGINT
        REFERENCES users(id) ON DELETE SET NULL,
    title VARCHAR(200) NOT NULL,
    slug VARCHAR(220) NOT NULL UNIQUE,
    content TEXT NOT NULL,
    image_url TEXT,
    is_published BOOLEAN NOT NULL DEFAULT TRUE,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE reviews (
    id BIGSERIAL PRIMARY KEY,
    user_id BIGINT NOT NULL
        REFERENCES users(id) ON DELETE CASCADE,
    product_id BIGINT NOT NULL
        REFERENCES products(id) ON DELETE CASCADE,
    rating INTEGER NOT NULL CHECK (rating BETWEEN 1 AND 5),
    comment TEXT,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    UNIQUE (user_id, product_id)
);

CREATE TABLE product_tags (
    id BIGSERIAL PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE product_tag_relations (
    id BIGSERIAL PRIMARY KEY,
    product_id BIGINT NOT NULL
        REFERENCES products(id) ON DELETE CASCADE,
    tag_id BIGINT NOT NULL
        REFERENCES product_tags(id) ON DELETE CASCADE,
    UNIQUE (product_id, tag_id)
);

CREATE INDEX idx_user_activities_user_id ON user_activities(user_id);
CREATE INDEX idx_products_category_id ON products(category_id);
CREATE INDEX idx_products_active_category ON products(is_active, category_id);
CREATE INDEX idx_products_name ON products(name);
CREATE INDEX idx_product_images_product_id ON product_images(product_id);
CREATE INDEX idx_wishlist_items_product_id ON wishlist_items(product_id);
CREATE INDEX idx_cart_items_product_id ON cart_items(product_id);
CREATE INDEX idx_orders_user_id ON orders(user_id);
CREATE INDEX idx_orders_status ON orders(status);
CREATE INDEX idx_orders_shipping_method_id ON orders(shipping_method_id);
CREATE INDEX idx_order_items_order_id ON order_items(order_id);
CREATE INDEX idx_order_items_product_id ON order_items(product_id);
CREATE INDEX idx_articles_category_id ON articles(category_id);
CREATE INDEX idx_articles_author_id ON articles(author_id);
CREATE INDEX idx_articles_published ON articles(is_published);
CREATE INDEX idx_reviews_product_id ON reviews(product_id);
CREATE INDEX idx_product_tag_relations_tag_id ON product_tag_relations(tag_id);

COMMIT;
