package com.silfi.peminjaman_ruang;

import androidx.annotation.NonNull;

public class Room {
    private int id;
    private String nama;
    private String lantai;
    private String kapasitas;
    private String fasilitas;
    private String foto;

    public Room(int id, String nama, String lantai, String kapasitas, String fasilitas, String foto) {
        this.id = id;
        this.nama = nama;
        this.lantai = lantai;
        this.kapasitas = kapasitas;
        this.fasilitas = fasilitas;
        this.foto = foto;
    }

    public Room(int id, String nama, String foto) {
        this.id = id;
        this.nama = nama;
        this.foto = foto;
    }

    public int getId() {
        return id;
    }

    public String getNama() {
        return nama;
    }

    public String getLantai() {
        return lantai;
    }

    public String getKapasitas() {
        return kapasitas;
    }

    public String getFasilitas() {
        return fasilitas;
    }

    public String getFoto() {
        return foto;
    }
}
