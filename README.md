# Tweety
 
Feel free to use it. 
New social media using [Laravel 7](https://laravel.com/)

![image](https://img.shields.io/github/license/Moranilt/tweety) ![image](https://img.shields.io/github/v/release/Moranilt/tweety?include_prereleases)

# Using Appache serve

First of all just follow this [**link**](https://laravel.com/docs/7.x/deployment) for deploying your project.
**Don't run ```php artisan config:cache```** It's important thing! Most appache servers does not support this.

### If you wants to **use appache** serve, you should do some changes:

> **Feel free to copy all of this code to your project**

For changing users avatar path you should change your method getAvatarAttribute for User model [(Laravel Mutators)](https://laravel.com/docs/7.x/eloquent-mutators#introduction):

```php
public function getAvatarAttribute($value)
{
   return asset($value ? "/storage/app/public/{$value}" : '/public/images/default-avatar.jpeg');
}
```
For images in tweets model:

```php
public function getPhotoAttribute($value)
    {
		if(isset($value)){
			return asset("/storage/app/public/{$value}");
		}else{
			return null;
		}
      
    }
```

Go to **views/components/** and change logo path by adding **'public/'** in app.blade.php, master.blade.php and profiles/show.blade.php(profiles banner):

```html
<img src="public/images/logo.svg" alt="tweety">
<img src="/public/images/default-profile-banner.jpg"  alt=""  class="mb-2" >
```

Go to master.blade.php at components folder and change all **assets** by adding **public/** before path:
```html
<script src="{{ asset('public/js/app.js') }}"></script>
<script src="{{ asset('public/js/nprogress.js') }}"></script>
<link rel='stylesheet' href="{{ asset('public/css/nprogress.css') }}"/>
<link href="{{ asset('public/css/main.css') }}" rel="stylesheet">
```

#### If you have some errors with images just delete image path from asset in views (_timeline, _timeline_profile, _tweet):
```<img src="{{ asset('storage/'.$tweet->photo }}" alt="your photo">``` to ``` <img src="{{ $tweet->photo }}" alt="your photo">```

The last thing. Add **.htaccess** file to this project at root with following code:

```htaccess
RewriteEngine on

# serve existing files in the /public folder as if they were in /
RewriteCond %{DOCUMENT_ROOT}public%{REQUEST_URI} -f
RewriteRule (.+) /public/$1 [L]

# route everything else to /public/index.php
RewriteRule ^ /public/index.php [L]
```

And that's all. Feel free to use it.

# Functionality


* Auth
* Tweets
* Likes
* Shares
* Chats (live)
* Notifications
* Following

# Models

* User
* Tweet
* Like
* Chat
* Conversation

> If you have some suggestions just let me know. You can send me an email on **unicornxoxo2@gmail.com** or **moranis.art.media@yandex.ru**

# License

This project is open-sourced software licensed under the [MIT](https://opensource.org/licenses/MIT)
