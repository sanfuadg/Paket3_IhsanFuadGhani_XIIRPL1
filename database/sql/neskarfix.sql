CREATE TABLE admin (
    username VARCHAR(255) PRIMARY KEY,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

CREATE TABLE siswa (
    nis VARCHAR(30) PRIMARY KEY,
    kelas VARCHAR(255) NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

CREATE TABLE kategori (
    id_kategori BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    ket_kategori VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

CREATE TABLE input_aspirasi (
    id_pelaporan BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nis VARCHAR(30) NOT NULL,
    id_kategori BIGINT UNSIGNED NOT NULL,
    lokasi VARCHAR(255) NOT NULL,
    ket TEXT NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    CONSTRAINT fk_input_aspirasi_siswa FOREIGN KEY (nis) REFERENCES siswa(nis)
        ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT fk_input_aspirasi_kategori FOREIGN KEY (id_kategori) REFERENCES kategori(id_kategori)
        ON UPDATE CASCADE
);

CREATE TABLE aspirasi (
    id_aspirasi BIGINT UNSIGNED PRIMARY KEY,
    status ENUM('Menunggu', 'Proses', 'Selesai') NOT NULL DEFAULT 'Menunggu',
    id_kategori BIGINT UNSIGNED NOT NULL,
    admin_username VARCHAR(255) NULL,
    feedback TEXT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    CONSTRAINT fk_aspirasi_input FOREIGN KEY (id_aspirasi) REFERENCES input_aspirasi(id_pelaporan)
        ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT fk_aspirasi_kategori FOREIGN KEY (id_kategori) REFERENCES kategori(id_kategori)
        ON UPDATE CASCADE,
    CONSTRAINT fk_aspirasi_admin FOREIGN KEY (admin_username) REFERENCES admin(username)
        ON UPDATE CASCADE ON DELETE SET NULL
);

INSERT INTO admin (username, password) VALUES ('admin', '$2y$12$6nLN.0.uS10Rrugvaz6e1.l5CVA3YwREJ/sxfFhw1Tp8Bx8kCVQwi');
INSERT INTO kategori (ket_kategori) VALUES
('Kebersihan'),
('Kerusakan Fasilitas'),
('Keamanan'),
('Kelistrikan'),
('Air & Sanitasi'),
('Lainnya');
