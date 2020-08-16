package com.silfi.peminjaman_ruang;

public class Booking {
    private String r_nama;
    private String u_nama;
    private String tanggal_pinjam;
    private String waktu_mulai;
    private String waktu_selesai;

    public Booking(String r_nama, String u_nama, String tanggal_pinjam, String waktu_mulai, String waktu_selesai) {
        this.r_nama = r_nama;
        this.u_nama = u_nama;
        this.tanggal_pinjam = tanggal_pinjam;
        this.waktu_mulai = waktu_mulai;
        this.waktu_selesai = waktu_selesai;
    }

    public String getR_nama() {
        return r_nama;
    }

    public String getU_nama() {
        return u_nama;
    }

    public String getTanggal_pinjam() {
        return tanggal_pinjam;
    }

    public String getWaktu_mulai() {
        return waktu_mulai;
    }

    public String getWaktu_selesai() {
        return waktu_selesai;
    }
}
