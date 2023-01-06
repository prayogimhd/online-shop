# NOT FOR SALE!
***
## ONLINE SHOP LARAVEL 9

- Laravel 9.45.1
- Midtrans
- Login with Google & Github
- Email Verification
- Yajra Datatables serverside
- Spatie

## Preview

![](https://github.com/prayogimhd/online-shop/blob/main/public/github/shop.png?raw=true)   |   ![](https://github.com/prayogimhd/online-shop/blob/main/public/github/my-order.png?raw=true)
:---:|:---:
![](https://github.com/prayogimhd/online-shop/blob/main/public/github/admin-order.png?raw=true)  |  ![](https://github.com/prayogimhd/online-shop/blob/main/public/github/configurasi.png?raw=true)


***

## Login Admin

- email: `admin@gmail.com`
- password: `wannabehero`

---

## Cara Install
1. **Clone Repo**

```
$ git clone https://github.com/prayogimhd/online-shop.git
```
2. Jalankan perintah

```shell
# install composer-dependency
$ composer install

$ npm install

# lalu jalankan perintah
$ cp .env.example .env

# kemudian menjalankan perintah key:generate
$ php artisan key:generate
```
3. **Konfigurasi database `.env`**

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=root
DB_PASSWORD=
```    
4. **Konfigurasi smtp `.env`**

<small>untuk mendapatkan Google App Password tutorialnya <a href="https://www.febooti.com/products/automation-workshop/tutorials/enable-google-app-passwords-for-smtp.html">disini</a> </small>
```bash
# pada MAIL_PASSWORD di isi password aplikasi bukan password email

MAIL_MAILER=smtp
MAIL_HOST=smtp.googlemail.com
MAIL_PORT=587
MAIL_USERNAME=email@email.com
MAIL_PASSWORD=xxxxxxxxx
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=email@email.com
MAIL_FROM_NAME="${APP_NAME}"
```  
5. **Konfigurasi Google & Github & Midtrans `.env`**

```bash
# Login with Google
GOOGLE_CLIENT_ID=xxxxxxxxxxxxxxxxxxx
GOOGLE_CLIENT_SECRET=xxxxxxxxxxxxxxx
GOOGLE_CLIENT_REDIRECT=xxxxxxxxxxxxxxx

# Login with Github
GITHUB_CLIENT_ID=xxxxxxxxxxxxxx
GITHUB_CLIENT_SECRET=xxxxxxxxxxxxx
GITHUB_CLIENT_REDIRECT=xxxxxxxxxxxxxxxx

# daftar midtrans untuk mendapatkan key
MIDTRANS_MERCHAT_ID=xxxxxxxxxxxx
MIDTRANS_CLIENT_KEY=SB-Mid-client-xxxxxxxx
MIDTRANS_SERVER_KEY=SB-Mid-server-xxxxxxxx
MIDTRANS_IS_PRODUCTION=false
```    

5. **Migrasi Database**

```bash
$ php artisan migrate
$ php artisan db:seed

# kemudian jalankan perintah
$ php artisan optimize:clear
```    
6. **Buka 2 `Terminal` dan jalankan perintah**
```bash
# menjalankan laravel
$ php artisan serve

# menjalankan vite di terminal kedua
$ npm run dev
```

<p style="color:yellow">Gimme a coffee? <a href="https://saweria.co/prayogimhd"> Saweria </a><p>
<p style="color:yellow">Jangan lupa bintangnya ⭐<p>
