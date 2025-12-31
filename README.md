# FURIMA アプリケーション
Laravel を使用したフリマアプリケーションです。  ユーザー登録・ログイン、商品出品、購入、いいね機能、マイページ管理など
基本的な EC サイト機能を実装しています。
---
## 使用技術
- PHP 8.4.15
- Laravel 12.42.0

### ■ フロント
- Blade
- CSS

### ■ データベース
- MySQL 8.4.7

### ■ Web サーバ
- Nginx（Docker コンテナ上）/1.29.3

### ■ インフラ
- Docker / Docker Compose

---

## 開発環境構築手順

### ① クローン
git clone git@github.com:s36-cell/Furima-app2.git
cd furima-app
### ② .env設定
- cp .env.example .env
- DB_CONNECTION=mysql
- DB_HOST=db
- DB_PORT=3306
- DB_DATABASE=laravel
- DB_USERNAME=laravel
- DB_PASSWORD=laravel
---
### ③ Docker 起動
- docker compose up -d
---
### ④ Laravel 初期設定
- docker exec -it laravel-app bash
- cd src
- composer install
- php artisan key:generate
- php artisan migrate
- php artisan db:seed
- php artisan storage:link
- exit
---
### ⑤ アクセス
- トップページ：http://localhost/
- ログイン：http://localhost/login
- 新規登録：http://localhost/register
- 商品一覧：http://localhost/items
- 商品詳細：http://localhost/items/{id}
- 出品ページ：http://localhost/items/create
- マイページ：http://localhost/mypage
- プロフィール編集：http://localhost/mypage/edit
- 購入ページ：http://localhost/purchase/{item}
- 画像：http://localhost/storage/...
---
### メール送信について
本アプリのメール送信は開発用メールサービスを使用しています。

- MailHog を使用している場合
  http://localhost:8025 でメールを確認できます

### 認証手順
1. 新規登録
2. 認証待ち画面へ遷移
3. MailHog / Mailtrap でメールを確認
4. 認証リンクをクリックして完了

## ER図
USERS {
        bigint id PK
        string name
        string email
        string password
        string profile_image
        string postal_code
        string address
        string phone
        timestamp email_verified_at
    }

    ITEMS {
        bigint id PK
        bigint user_id FK
        string name
        int price
        string brand
        text description
        string image_path
        string condition
        boolean is_sold
        bigint buyer_id FK
        timestamps
    }

    CATEGORIES {
        bigint id PK
        string name
        timestamps
    }

    CATEGORY_ITEM {
        bigint id PK
        bigint item_id FK
        bigint category_id FK
    }

    COMMENTS {
        bigint id PK
        bigint user_id FK
        bigint item_id FK
        text comment
        timestamps
    }

    LIKES {
        bigint id PK
        bigint user_id FK
        bigint item_id FK
        timestamps
    }

    ADDRESSES {
        bigint id PK
        bigint user_id FK
        string postal_code
        string address
        timestamps
    }

    USERS ||--o{ ITEMS : "出品する"
    USERS ||--o{ COMMENTS : "コメントする"
    USERS ||--o{ LIKES : "いいね"
    USERS ||--o{ ADDRESSES : "住所を持つ"

    ITEMS ||--o{ COMMENTS : "コメントされる"
    ITEMS ||--o{ LIKES : "いいねされる"
    ITEMS }o--o{ CATEGORIES : "分類される"