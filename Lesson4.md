# Eloquent

Eloquent là **ORM (Object-Relational Mapping)** mạnh mẽ của Laravel, cho phép bạn tương tác với cơ sở dữ liệu bằng các model thay vì viết trực tiếp các câu lệnh SQL. Mỗi bảng trong cơ sở dữ liệu sẽ tương ứng với một model trong Laravel.

## Các truy vấn cơ bản

**1. Lấy tất cả bản ghi**

```php
$users = User::all();
```

**2. Lấy bản ghi theo ID**

```php
$user = User::find(1);
$user = User::where('id', 1);
```

**3. Lấy bản ghi đầu tiên**

```php
$user = User::first();
```

**4. Lấy nhiều bản ghi với điều kiện**

```php
$users = User::where('status', 'active')->get();
```

**5. Lấy bản ghi duy nhất với điều kiện**

```php
$user = User::where('email', 'example@example.com')->first();
```

**6. Thêm bản ghi mới (Cách 1)**

```php
$user = new User;
$user->name = 'John Doe';
$user->email = 'johndoe@example.com';
$user->save();
```

**6. Thêm bản ghi mới (Cách 2)**

```php
$data = [
    'name' => 'John Doe',
    'email' => 'johndoe@example.com'
];
User::create($data);
```

**7. Cập nhật bản ghi (Cách 1)**

```php
$user = User::find(1);
$user->name = 'John Smith';
$user->save();
```

**7. Cập nhật bản ghi (Cách 2)**

```php
$data = [
    'name' => 'John Doe',
];
User::where('id', 1)->update($data);
```

**8. Xóa bản ghi**

```php
$user = User::find(1);
$user->delete();
```

**9. Các phương thức khác**

```php
// Truy vấn với nhiều điều kiện
$users = User::where('status', 'active')
             ->where('role', 'admin')
             ->get();
// Truy vấn hoặc
$users = User::where('status', 'active')
             ->orWhere('role', 'admin')
             ->get();
// Sắp xếp kết quả
$users = User::orderBy('name', 'asc')->get();
// Giới hạn số lượng kết quả
$users = User::take(10)->get();
// Phân trang
$users = User::paginate(15); // echo $user->links('pagination::bootstrap-5') trong blade
// Các phương thức tổng hợp khác
$count = User::count();
$max = User::max('age');
$min = User::min('age');
$avg = User::avg('age');
$sum = User::sum('age');
```

## Truy vấn Eloquent giữa nhiều CSDL

Trong Emoquent Model cần chỉ rõ connection muốn kết nối. Nếu không Model tự động truy cập connection mặc định trong file _.env_

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Kết nối đến cơ sở dữ liệu 'mysql_secondary'
    protected $connection = 'mysql_secondary';
    protected $table = 'products';
}

```

## Các quan hệ trong Eloquent Model

**1. Quan hệ One to One (Một - Một)**
Ví dụ: Một User chỉ có một Profile
Bảng users(id, name, email)
Bảng profiles(id, user_id (FK), phone_number)

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
}

```

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

```

```php
// Sử dụng
// Lấy thông tin Profile của một User
$user = User::find(1);
$profile = $user->profile;

// Lấy User từ Profile
$profile = Profile::find(1);
$user = $profile->user;

```

**2. Quan hệ One to Many (Một - Nhiều)**
Ví dụ: Một User có nhiều bài viết (Posts).
Bảng users(id, name, email)
Bảng posts(id, user_id, title)

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}

```

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

```

```php
// Sử dụng
// Lấy tất cả bài viết của User
$user = User::find(1);
$posts = $user->posts;

// Lấy User từ bài viết
$post = Post::find(1);
$user = $post->user;

```

**3. Quan hệ Many to Many (Nhiều - Nhiều)**
Ví dụ: Một User có thể thuộc nhiều Roles, Một Roles cũng có thể thuộc về nhiều User

Ví dụ:
Bảng users(id, name)
Bảng roles(id, name)
Bảng role_user (user_id , role_id)

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}

```

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}

```

```php
// Sử dụng
// Lấy tất cả Roles của User
$user = User::find(1);
$roles = $user->roles;

// Lấy tất cả Users của Role
$role = Role::find(1);
$users = $role->users;

// Gắn role cho user
$user->roles()->attach([1, 2]);  // Gán nhiều role
$user->roles()->detach(1);       // Bỏ role
$user->roles()->sync([2, 3]);    // Đồng bộ role (xóa cũ, thêm mới)

```

**4. Quan hệ One to Many (Polymorphic)**
Mô tả: Một model có thể thuộc nhiều model khác nhau bằng một cột duy nhất.

Ví dụ: Một Hình ảnh (Image) có thể thuộc về User, Product hoặc Post

Bảng images(id , imageable_id, imageable_type)
Bảng users (id, name)
Bảng products (id, name)

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public function imageable()
    {
        return $this->morphTo();
    }
}

```

```php
// User.php
public function images()
{
    return $this->morphMany(Image::class, 'imageable');
}
```

```php
// Product.php
public function images()
{
    return $this->morphMany(Image::class, 'imageable');
}
```

```php
// Sử dụng
// Lấy hình ảnh của User
$user = User::find(1);
$images = $user->images;

// Thêm hình ảnh cho Product
$product = Product::find(1);
$product->images()->create(['path' => 'product.jpg']);

```

**5. Quan hệ Many to Many (Polymorphic)**
Mô tả: Một model có thể thuộc nhiều model khác nhau với nhiều bản ghi thông qua bảng trung gian.

Ví dụ: Một Tag có thể áp dụng cho Bài viết (Post) hoặc Video.

Bảng tags(id, name)
Bảng taggables(tag_id (FK), taggable_id, taggable_type)

Bài tập:

- Sử dụng quan hệ trong model
- Truy vấn, CRUD trong CSDL bằng Eloquent
