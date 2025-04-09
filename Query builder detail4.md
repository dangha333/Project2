## Advanced Join Clauses trong Laravel là gì?

Advanced Join Clauses trong Laravel cho phép bạn thực hiện các phép JOIN phức tạp hơn bằng cách sử dụng hàm callback với lớp JoinClause. Điều này cho phép bạn:

- Kết hợp nhiều điều kiện với on(), orOn().
- Sử dụng where(), whereBetween(), whereIn()... trực tiếp trong câu lệnh JOIN.
- Xây dựng các truy vấn phức tạp hơn so với join() thông thường.

**Ví dụ:**
`Dùng on() và orOn()`

```php
use Illuminate\Database\Query\JoinClause;

$users = DB::table('users')
    ->join('contacts', function (JoinClause $join) {
        $join->on('users.id', '=', 'contacts.user_id')
             ->orOn('users.email', '=', 'contacts.email');
    })
    ->get();

```

**Ý nghĩa:**
Kết nối bảng users với contacts.

**Điều kiện nối**

- users.id = contacts.user_id hoặc
- users.email = contacts.email.

**Câu lệnh SQL tương đương:**

```php
SELECT * FROM users
JOIN contacts
ON users.id = contacts.user_id
OR users.email = contacts.email;

```

**Ví dụ**
`Dùng where() trong Join`

```php
use Illuminate\Database\Query\JoinClause;

$users = DB::table('users')
    ->join('contacts', function (JoinClause $join) {
        $join->on('users.id', '=', 'contacts.user_id')
             ->where('contacts.user_id', '>', 5);
    })
    ->get();

```

**Ý nghĩa**
Kết nối bảng users với contacts.

**Điều kiện nối:**

- users.id = contacts.user_id
- contacts.user_id > 5 (lọc kết quả ngay trong JOIN).

**Câu lệnh SQL tương đương**

```php
SELECT * FROM users
JOIN contacts
ON users.id = contacts.user_id
AND contacts.user_id > 5;
```

**So sánh**
`where() trong Join:`

- Điều kiện lọc ngay khi thực hiện JOIN.
- Hiệu năng tốt hơn vì giảm số lượng bản ghi trước khi JOIN.

```php
// Điều kiện trong JOIN (lọc trước)
DB::table('users')
    ->join('contacts', function ($join) {
        $join->on('users.id', '=', 'contacts.user_id')
             ->where('contacts.user_id', '>', 5);
    })
    ->get();

// Điều kiện ngoài JOIN (lọc sau)
DB::table('users')
    ->join('contacts', 'users.id', '=', 'contacts.user_id')
    ->where('contacts.user_id', '>', 5)
    ->get();

```

**Nâng cao**

```php
use Illuminate\Database\Query\JoinClause;

$users = DB::table('users')
    ->join('contacts', function (JoinClause $join) {
        $join->on('users.id', '=', 'contacts.user_id')
             ->where('contacts.is_active', '=', 1)
             ->orWhere('contacts.type', '=', 'primary');
    })
    ->get();



use Illuminate\Database\Query\JoinClause;

$users = DB::table('users')
    ->leftJoin('contacts', function (JoinClause $join) {
        $join->on('users.id', '=', 'contacts.user_id')
             ->whereNull('contacts.deleted_at');
    })
    ->get();

```

**Khi nào nên dùng Advanced Join Clauses?**

- Khi cần nhiều điều kiện JOIN phức tạp (AND, OR, WHERE).
- Khi cần lọc dữ liệu trực tiếp trong JOIN để tối ưu hiệu năng.
- Khi JOIN với các bảng có dữ liệu lớn và chỉ muốn lấy kết quả cần thiết.

## Subquery Joins trong Laravel là gì?

Subquery Joins trong Laravel cho phép bạn thực hiện JOIN với một truy vấn con (subquery). Điều này rất hữu ích khi bạn cần lấy dữ liệu từ **kết quả trung gian** hoặc **dữ liệu đã xử lý trước** thay vì từ bảng trực tiếp.

**Ví dụ**
`Tạo Subquery ($latestPosts)`

```php
$latestPosts = DB::table('posts')
    ->select('user_id', DB::raw('MAX(created_at) as last_post_created_at'))
    ->where('is_published', true)
    ->groupBy('user_id');

// Chọn user_id và thời gian bài viết gần nhất (MAX(created_at)).
// Chỉ lấy các bài viết đã xuất bản (is_published = true).
// Nhóm theo user_id, tức là mỗi người dùng chỉ có một bản ghi với bài viết mới nhất.

// Câu lệnh SQL tương đương:
// SELECT user_id, MAX(created_at) AS last_post_created_at
// FROM posts
// WHERE is_published = true
// GROUP BY user_id;
```

`Thực hiện joinSub() với bảng users`

```php
$users = DB::table('users')
    ->joinSub($latestPosts, 'latest_posts', function (JoinClause $join) {
        $join->on('users.id', '=', 'latest_posts.user_id');
    })->get();

// Join bảng users với kết quả của subquery ($latestPosts).
// Điều kiện JOIN: users.id = latest_posts.user_id.

// Câu lệnh tương đương

// SELECT users.*, latest_posts.last_post_created_at
// FROM users
// JOIN (
//     SELECT user_id, MAX(created_at) AS last_post_created_at
//     FROM posts
//     WHERE is_published = true
//     GROUP BY user_id
// ) AS latest_posts
// ON users.id = latest_posts.user_id;

```

**Khi nào nên dùng joinSub()?**

1. Khi cần JOIN với dữ liệu đã xử lý trước:
   - Ví dụ: Lấy bài viết mới nhất của mỗi người dùng.
2. Khi JOIN với các phép tính tổng hợp (aggregate):
   - Ví dụ: Tính số lượng đơn hàng của mỗi khách hàng
3. Khi JOIN với các truy vấn phức tạp mà không thể làm trực tiếp:
   - Ví dụ: Kết hợp nhiều bảng với điều kiện con.

**Ví dụ mở rộng**

```php
//  Lấy mỗi người dùng với đơn hàng có giá trị cao nhất
$maxOrders = DB::table('orders')
    ->select('user_id', DB::raw('MAX(amount) as max_amount'))
    ->groupBy('user_id');

$users = DB::table('users')
    ->joinSub($maxOrders, 'max_orders', function ($join) {
        $join->on('users.id', '=', 'max_orders.user_id');
    })
    ->get();

```

```php
// Lấy khách hàng có số đơn hàng lớn hơn 10
$orderCount = DB::table('orders')
    ->select('user_id', DB::raw('COUNT(*) as total_orders'))
    ->groupBy('user_id')
    ->having('total_orders', '>', 10);

$users = DB::table('users')
    ->joinSub($orderCount, 'order_count', function ($join) {
        $join->on('users.id', '=', 'order_count.user_id');
    })
    ->get();

```
