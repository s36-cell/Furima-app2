BEGIN TRANSACTION;
CREATE TABLE IF NOT EXISTS "addresses" (
	"id"	integer NOT NULL,
	"user_id"	integer NOT NULL,
	"postal_code"	varchar NOT NULL,
	"address"	varchar NOT NULL,
	"building"	varchar,
	"created_at"	datetime,
	"updated_at"	datetime,
	PRIMARY KEY("id" AUTOINCREMENT),
	FOREIGN KEY("user_id") REFERENCES "users"("id") on delete cascade
);
CREATE TABLE IF NOT EXISTS "cache" (
	"key"	varchar NOT NULL,
	"value"	text NOT NULL,
	"expiration"	integer NOT NULL,
	PRIMARY KEY("key")
);
CREATE TABLE IF NOT EXISTS "cache_locks" (
	"key"	varchar NOT NULL,
	"owner"	varchar NOT NULL,
	"expiration"	integer NOT NULL,
	PRIMARY KEY("key")
);
CREATE TABLE IF NOT EXISTS "categories" (
	"id"	integer NOT NULL,
	"name"	varchar NOT NULL,
	"created_at"	datetime,
	"updated_at"	datetime,
	PRIMARY KEY("id" AUTOINCREMENT)
);
CREATE TABLE IF NOT EXISTS "category_item" (
	"id"	integer NOT NULL,
	"category_id"	integer NOT NULL,
	"item_id"	integer NOT NULL,
	"created_at"	datetime,
	"updated_at"	datetime,
	PRIMARY KEY("id" AUTOINCREMENT),
	FOREIGN KEY("category_id") REFERENCES "categories"("id") on delete cascade,
	FOREIGN KEY("item_id") REFERENCES "items"("id") on delete cascade
);
CREATE TABLE IF NOT EXISTS "comments" (
	"id"	integer NOT NULL,
	"user_id"	integer NOT NULL,
	"item_id"	integer NOT NULL,
	"comment"	text NOT NULL,
	"created_at"	datetime,
	"updated_at"	datetime,
	PRIMARY KEY("id" AUTOINCREMENT),
	FOREIGN KEY("item_id") REFERENCES "items"("id") on delete cascade,
	FOREIGN KEY("user_id") REFERENCES "users"("id") on delete cascade
);
CREATE TABLE IF NOT EXISTS "failed_jobs" (
	"id"	integer NOT NULL,
	"uuid"	varchar NOT NULL,
	"connection"	text NOT NULL,
	"queue"	text NOT NULL,
	"payload"	text NOT NULL,
	"exception"	text NOT NULL,
	"failed_at"	datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY("id" AUTOINCREMENT)
);
CREATE TABLE IF NOT EXISTS "items" (
	"id"	integer NOT NULL,
	"user_id"	integer NOT NULL,
	"name"	varchar NOT NULL,
	"price"	integer NOT NULL,
	"brand"	varchar,
	"description"	text NOT NULL,
	"image_path"	varchar NOT NULL,
	"condition"	varchar NOT NULL,
	"is_sold"	tinyint(1) NOT NULL DEFAULT '0',
	"created_at"	datetime,
	"updated_at"	datetime,
	"buyer_id"	integer,
	PRIMARY KEY("id" AUTOINCREMENT),
	FOREIGN KEY("user_id") REFERENCES "users"("id") on delete cascade
);
CREATE TABLE IF NOT EXISTS "job_batches" (
	"id"	varchar NOT NULL,
	"name"	varchar NOT NULL,
	"total_jobs"	integer NOT NULL,
	"pending_jobs"	integer NOT NULL,
	"failed_jobs"	integer NOT NULL,
	"failed_job_ids"	text NOT NULL,
	"options"	text,
	"cancelled_at"	integer,
	"created_at"	integer NOT NULL,
	"finished_at"	integer,
	PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "jobs" (
	"id"	integer NOT NULL,
	"queue"	varchar NOT NULL,
	"payload"	text NOT NULL,
	"attempts"	integer NOT NULL,
	"reserved_at"	integer,
	"available_at"	integer NOT NULL,
	"created_at"	integer NOT NULL,
	PRIMARY KEY("id" AUTOINCREMENT)
);
CREATE TABLE IF NOT EXISTS "likes" (
	"id"	integer NOT NULL,
	"user_id"	integer NOT NULL,
	"item_id"	integer NOT NULL,
	"created_at"	datetime,
	"updated_at"	datetime,
	PRIMARY KEY("id" AUTOINCREMENT),
	FOREIGN KEY("item_id") REFERENCES "items"("id") on delete cascade,
	FOREIGN KEY("user_id") REFERENCES "users"("id") on delete cascade
);
CREATE TABLE IF NOT EXISTS "migrations" (
	"id"	integer NOT NULL,
	"migration"	varchar NOT NULL,
	"batch"	integer NOT NULL,
	PRIMARY KEY("id" AUTOINCREMENT)
);
CREATE TABLE IF NOT EXISTS "password_reset_tokens" (
	"email"	varchar NOT NULL,
	"token"	varchar NOT NULL,
	"created_at"	datetime,
	PRIMARY KEY("email")
);
CREATE TABLE IF NOT EXISTS "sessions" (
	"id"	varchar NOT NULL,
	"user_id"	integer,
	"ip_address"	varchar,
	"user_agent"	text,
	"payload"	text NOT NULL,
	"last_activity"	integer NOT NULL,
	PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "users" (
	"id"	integer NOT NULL,
	"name"	varchar NOT NULL,
	"email"	varchar NOT NULL,
	"email_verified_at"	datetime,
	"password"	varchar NOT NULL,
	"remember_token"	varchar,
	"created_at"	datetime,
	"updated_at"	datetime,
	"two_factor_secret"	text,
	"two_factor_recovery_codes"	text,
	"two_factor_confirmed_at"	datetime,
	"profile_image"	varchar,
	"postal_code"	varchar,
	"address"	varchar,
	"phone"	varchar,
	PRIMARY KEY("id" AUTOINCREMENT)
);
INSERT INTO "addresses" VALUES (1,1,'123-1234','神奈川県','マンション','2025-12-31 11:56:09','2025-12-31 11:56:09');
INSERT INTO "cache" VALUES ('laravel-cache-356a192b7913b04c54574d18c28d46e6395428ab:timer','i:1767100136;',1767100136);
INSERT INTO "cache" VALUES ('laravel-cache-356a192b7913b04c54574d18c28d46e6395428ab','i:2;',1767100136);
INSERT INTO "cache" VALUES ('laravel-cache-fdfbe7b6a526c64dccff88c7aed4ec36:timer','i:1767147902;',1767147902);
INSERT INTO "cache" VALUES ('laravel-cache-fdfbe7b6a526c64dccff88c7aed4ec36','i:1;',1767147902);
INSERT INTO "categories" VALUES (1,'家電',NULL,NULL);
INSERT INTO "categories" VALUES (2,'ファッション',NULL,NULL);
INSERT INTO "categories" VALUES (3,'食品',NULL,NULL);
INSERT INTO "categories" VALUES (4,'日用品',NULL,NULL);
INSERT INTO "categories" VALUES (5,'コスメ',NULL,NULL);
INSERT INTO "categories" VALUES (6,'その他',NULL,NULL);
INSERT INTO "category_item" VALUES (1,4,11,NULL,NULL);
INSERT INTO "category_item" VALUES (2,6,11,NULL,NULL);
INSERT INTO "comments" VALUES (1,1,2,'何年製のものですか？','2025-12-30 22:52:23','2025-12-30 22:52:23');
INSERT INTO "comments" VALUES (2,1,11,'綺麗にしてから発送してください','2025-12-31 09:18:20','2025-12-31 09:18:20');
INSERT INTO "items" VALUES (1,1,'腕時計',15000,'Rolax','スタイリッシュなデザインのメンズ腕時計','items/watch.jpg','良好',1,'2025-12-30 22:01:50','2025-12-30 22:51:32',1);
INSERT INTO "items" VALUES (2,1,'HDD',5000,'西芝','高速で信頼性の高いハードディスク','items/hdd.jpg','目立った傷や汚れなし',1,'2025-12-30 22:01:50','2025-12-31 12:18:36',1);
INSERT INTO "items" VALUES (3,1,'玉ねぎ3束',300,NULL,'新鮮な玉ねぎ3束のセット','items/onion.jpg','やや傷や汚れあり',0,'2025-12-30 22:01:50','2025-12-30 22:01:50',NULL);
INSERT INTO "items" VALUES (4,1,'革靴',4000,NULL,'クラシックなデザインの革靴','items/shoes.jpg','状態が悪い',0,'2025-12-30 22:01:50','2025-12-30 22:01:50',NULL);
INSERT INTO "items" VALUES (5,1,'ノートPC',45000,NULL,'高性能なノートパソコン','items/laptop.jpg','良好',0,'2025-12-30 22:01:50','2025-12-30 22:01:50',NULL);
INSERT INTO "items" VALUES (6,1,'マイク',8000,NULL,'高音質のレコーディング用マイク','items/mic.jpg','目立った傷や汚れなし',0,'2025-12-30 22:01:50','2025-12-30 22:01:50',NULL);
INSERT INTO "items" VALUES (7,1,'ショルダーバッグ',3500,NULL,'おしゃれなショルダーバッグ','items/bag.jpg','やや傷や汚れあり',1,'2025-12-30 22:01:50','2025-12-30 22:01:50',NULL);
INSERT INTO "items" VALUES (8,1,'タンブラー',500,NULL,'使いやすいタンブラー','items/tumbler.jpg','状態が悪い',1,'2025-12-30 22:01:50','2025-12-30 22:38:58',NULL);
INSERT INTO "items" VALUES (9,1,'コーヒーミル',4000,'Starbacks','手動のコーヒーミル','items/coffeemill.jpg','良好',0,'2025-12-30 22:01:50','2025-12-30 22:01:50',NULL);
INSERT INTO "items" VALUES (10,1,'メイクセット',2500,NULL,'便利なメイクアップセット','items/makeup.jpg','目立った傷や汚れなし',0,'2025-12-30 22:01:50','2025-12-30 22:01:50',NULL);
INSERT INTO "items" VALUES (11,1,'インテリア',300,NULL,'埃かぶってます','item_images/1VGUfmcsLDiK8VdP8mG7BJPBcjAl6XgwPmp7bivP.png','目立った傷や汚れなし',1,'2025-12-31 09:16:29','2025-12-31 11:24:45',1);
INSERT INTO "likes" VALUES (1,1,2,'2025-12-30 22:51:45','2025-12-30 22:51:45');
INSERT INTO "likes" VALUES (2,1,11,'2025-12-31 10:52:57','2025-12-31 10:52:57');
INSERT INTO "migrations" VALUES (1,'0001_01_01_000000_create_users_table',1);
INSERT INTO "migrations" VALUES (2,'0001_01_01_000001_create_cache_table',1);
INSERT INTO "migrations" VALUES (3,'0001_01_01_000002_create_jobs_table',1);
INSERT INTO "migrations" VALUES (4,'2025_12_13_083520_add_two_factor_columns_to_users_table',1);
INSERT INTO "migrations" VALUES (5,'2025_12_14_111428_create_items_table',1);
INSERT INTO "migrations" VALUES (6,'2025_12_29_122528_create_categories_table',1);
INSERT INTO "migrations" VALUES (7,'2025_12_29_123239_create_category_item_table',1);
INSERT INTO "migrations" VALUES (8,'2025_12_29_150532_create_comments_table',1);
INSERT INTO "migrations" VALUES (9,'2025_12_29_162516_create_likes_table',1);
INSERT INTO "migrations" VALUES (10,'2025_12_29_165332_create_addresses_table',1);
INSERT INTO "migrations" VALUES (11,'2025_12_30_203514_add_profile_columns_to_users_table',1);
INSERT INTO "migrations" VALUES (12,'2025_12_30_224906_add_buyer_id_to_items_table',2);
INSERT INTO "sessions" VALUES ('hveY5bOdrtuIBQVxb9Vw6ZqXmvQ8xsRpKHauNtSZ',1,'192.168.65.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','YTo2OntzOjY6Il90b2tlbiI7czo0MDoiRW1mYVlSZ1RKQ3RzcDU1bFpsWHpZUDFNRHE1aTRpOXpKVHBmdzlGeCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTY6Imh0dHA6Ly9sb2NhbGhvc3QiO3M6NToicm91dGUiO3M6MTE6Iml0ZW1zLmluZGV4Ijt9czozOiJ1cmwiO2E6MDp7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoxNjoicHVyY2hhc2VfaXRlbV9pZCI7aToyO30=',1767151120);
INSERT INTO "users" VALUES (1,'a','aa@hh','2025-12-30 22:08:35','$2y$12$rmZq/3ibwcamWOHICWp2E.TAH8Lwm4SWxI/sxqkQnqtB6RadFwmQa',NULL,'2025-12-30 21:59:40','2025-12-30 22:08:56',NULL,NULL,NULL,'profile_images/1jyp89NVN1siRfQlDh96g5AE0N8ojo4p19p0z0w8.png','123-1234','神奈川県','00000000000');
CREATE UNIQUE INDEX IF NOT EXISTS "failed_jobs_uuid_unique" ON "failed_jobs" (
	"uuid"
);
CREATE INDEX IF NOT EXISTS "jobs_queue_index" ON "jobs" (
	"queue"
);
CREATE UNIQUE INDEX IF NOT EXISTS "likes_user_id_item_id_unique" ON "likes" (
	"user_id",
	"item_id"
);
CREATE INDEX IF NOT EXISTS "sessions_last_activity_index" ON "sessions" (
	"last_activity"
);
CREATE INDEX IF NOT EXISTS "sessions_user_id_index" ON "sessions" (
	"user_id"
);
CREATE UNIQUE INDEX IF NOT EXISTS "users_email_unique" ON "users" (
	"email"
);
COMMIT;
