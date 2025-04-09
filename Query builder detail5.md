## joinLateral() và leftJoinLateral() trong Laravel là gì?

joinLateral() và leftJoinLateral() là các phương thức trong Laravel dùng để thực hiện Lateral Join – một dạng subquery mà mỗi hàng của bảng chính có thể kết hợp với kết quả con động dựa trên giá trị của chính hàng đó.

**Ví dụ**

```php
$latestPosts = DB::table('posts')
    ->select('id as post_id', 'title as post_title', 'created_at as post_created_at')
    ->whereColumn('user_id', 'users.id') // Liên kết với bảng users
    ->orderBy('created_at', 'desc') // Sắp xếp bài viết mới nhất
    ->limit(3); // Lấy 3 bài viết mới nhất cho mỗi user

$users = DB::table('users')
    ->joinLateral($latestPosts, 'latest_posts')
    ->get();

```

`Subquery $latestPosts`

1. Chọn các cột:

   - id → post_id
   - title → post_title
   - created_at → post_created_at

2. Điều kiện: whereColumn('user_id', 'users.id')
   - So sánh cột user_id của bảng posts với id của bảng users.
3. Sắp xếp: bài viết mới nhất trước
4. Giới hạn: lấy tối đa 3 bài viết.

Tương đương SQL:

```php
// SELECT id AS post_id, title AS post_title, created_at AS post_created_at
// FROM posts
// WHERE user_id = users.id
// ORDER BY created_at DESC
// LIMIT 3
```

`joinLateral()`

- Kết hợp bảng users với subquery $latestPosts.
- Lateral Join cho phép mỗi dòng từ bảng chính (users) thực thi subquery với dữ liệu tương ứng.

Tương đương SQL

```php
SELECT users.*, latest_posts.*
FROM users
JOIN LATERAL (
    SELECT id AS post_id, title AS post_title, created_at AS post_created_at
    FROM posts
    WHERE user_id = users.id
    ORDER BY created_at DESC
    LIMIT 3
) AS latest_posts ON TRUE;

```
