# Menggunakan gambar (image) Debian
FROM debian:bullseye

# Menentukan direktori kerja (working directory)
WORKDIR /var/www/html

# Memperbarui paket yang ada dan menginstal dependensi
RUN apt-get update && apt-get install -y \
    curl \
    wget \
    gnupg2 \
    lsb-release \
    apt-transport-https \
    ca-certificates \
    && rm -rf /var/lib/apt/lists/*

# Mengunduh dan mengimpor kunci GPG PHP
RUN wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg

# Menambahkan repositori PHP 8.1 ke dalam daftar sumber paket
RUN echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" | tee /etc/apt/sources.list.d/php.list

# Memperbarui kembali paket yang ada dan menginstal PHP 8.1 beserta ekstensi yang umum digunakan
RUN apt-get update && apt-get install -y \
    php \
    php-cli \
    php-fpm \
    php-mysql \
    php-curl \
    php-gd \
    php-mbstring \
    php-xml \
    php-zip && \
    apt-get clean

RUN apt install -y apache2 libapache2-mod-php && \
    apt-get clean
# # Menyalin kode aplikasi ke dalam direktori kerja di dalam kontainer
# COPY . /app

# # Menjalankan perintah untuk memulai aplikasi
# CMD ["php", "app.php"]