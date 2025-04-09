## Tổng quan về laravel và cơ sở dữ liệu

## 1. Migration

**- Lệnh tạo migration**

```cmd
php artisan make:migration create_tableName_table
```

**- Run migration**

```cmd
php artisan migrate
php artisan migrate --path=database\migrations\fileName.php
```

**- Rolling back**

```cmd
php artisan migrate:rollback
php artisan migrate:rollback --step=3
```

**- Reset**

```cmd
php artisan migrate:reset
```

**- Refresh (rollback + migrate)**

```cmd
php artisan migrate:refresh
```

**- Fresh (drop all table and migrate)**

```cmd
php artisan migrate:fresh
```

## 2. Create table

```php
Schema::create('users', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->timestamps();
});
```

**+ Các kiểu dữ liệu cơ bản**

```text
+ string($column, $length = 255): Một chuỗi ký tự có độ dài tối đa là 255 ký tự.
+ text($column): Một chuỗi văn bản dài, thường dùng cho các nội dung dài như mô tả.
+ integer($column, $autoIncrement = false, $unsigned = false): Một số nguyên.
+ bigInteger($column, $autoIncrement = false, $unsigned = false): Một số nguyên lớn.
+ tinyInteger($column, $autoIncrement = false, $unsigned = false): Một số nguyên nhỏ.
+ smallInteger($column, $autoIncrement = false, $unsigned = false): Một số nguyên nhỏ hơn so với integer.
+ mediumInteger($column, $autoIncrement = false, $unsigned = false): Một số nguyên lớn hơn smallInteger nhưng nhỏ hơn bigInteger.
+ boolean($column): Một giá trị boolean (true hoặc false).
+ decimal($column, $total = 8, $places = 2): Một số thập phân với tổng số chữ số và số chữ số thập phân cụ thể.
+ float($column, $total = 8, $places = 2): Một số thực với tổng số chữ số và số chữ số thập phân cụ thể.
+ double($column, $total = null, $places = null): Một số thực lớn hơn float.
+ binary($column): Một chuỗi nhị phân.
```

**+ Kiểu dữ liệu ngày giờ**

```text
+ date($column): Một ngày (không bao gồm thời gian).
+ dateTime($column, $precision = 0): Ngày và thời gian.
+ dateTimeTz($column, $precision = 0): Ngày và thời gian với múi giờ.
+ time($column, $precision = 0): Thời gian (không bao gồm ngày).
+ timeTz($column, $precision = 0): Thời gian với múi giờ.
+ timestamp($column, $precision = 0): Dấu thời gian (bao gồm ngày và thời gian).
+ timestampTz($column, $precision = 0): Dấu thời gian với múi giờ.
+ year($column): Một năm (4 chữ số).
```

**+ Các kiểu dữ liệu khác**

```text
+ enum($column, array $allowed): Một chuỗi với giá trị từ danh sách các giá trị cho trước.
+ json($column): Một chuỗi JSON.
```

**+ Tùy chọn**

```text
+ nullable(): Cho phép cột nhận giá trị null.
+ default($value): Đặt giá trị mặc định cho cột.
+ unsigned(): Đặt cột là số nguyên không dấu.
+ unique(): Đảm bảo giá trị trong cột là duy nhất.
+ index(): Tạo chỉ mục cho cột.
+ primary(): Đặt cột làm khoá chính.
```

**+ Một số điều kiện và lệnh khác**

```php
Schema::hasTable('users')
Schema::hasColumn('users', 'email')
Schema::hasIndex('users', ['email'], 'unique')


$table->charset('utf8mb4');
$table->collation('utf8mb4_unicode_ci');
$table->comment('Business calculations');
```

## 3. Updating Tables

```cmd
php artisan make:migration update_tableName_table
```

```php
Schema::table('users', function (Blueprint $table) {
    $table->string('name', 250);
});
```

```php
// Rename and drop column
$table->renameColumn('from', 'to');
$table->dropColumn(['votes', 'avatar', 'location']);
// Rename and drop table
Schema::rename($from, $to);
Schema::drop('users');
// Lưu ý đối với drop table ta nên tạo 1 migration mới cho công việc này
// php artisan make:migration drop_tableName_table
```

## 4. Foreign Key Constraints

```php
$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
```

## Migration với 2 CSDL khác nhau

Giả sử chúng ta có 2 connections trong _config/databse.php_ như sau

```php
'connections' => [
    'mysql' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '127.0.0.1'),
        'database' => env('DB_DATABASE', 'database_1'),
    ],
    'mysql_secondary' => [
        'driver' => 'mysql',
        'host' => env('DB_SECONDARY_HOST', '127.0.0.1'),
        'database' => env('DB_SECONDARY_DATABASE', 'database_2'),
    ],
],

```

Khi chạy migrate, nó sẽ tự động chạy vào CSDL mặc định có giá trị **DB_CONNECTION=mysql** trong file .env

Nếu chúng ta muốn chỉ định db chạy migration, ta cấu hình như sau:

```php
// Ví dụ tạo bảng Orders
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up(): void
    {
        Schema::connection('mysql_secondary')->create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::connection('mysql_secondary')->dropIfExists('orders');
    }
}

```
