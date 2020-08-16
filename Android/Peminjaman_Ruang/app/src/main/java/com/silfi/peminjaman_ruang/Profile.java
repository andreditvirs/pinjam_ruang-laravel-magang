package com.silfi.peminjaman_ruang;

public class Profile {
    private String nip;
    private String username;
    private String nama;
    private String jenis_kelamin;
    private String foto;
    private String department_name;
    private String position_in_department;

    public Profile(String nip, String username, String nama,String jenis_kelamin, String foto, String department_name, String position_in_department) {
        this.nip = nip;
        this.username = username;
        this.nama = nama;
        this.jenis_kelamin = jenis_kelamin;
        this.foto = foto;
        this.department_name = department_name;
        this.position_in_department = position_in_department;
    }

    public Profile(String nip, String username, String foto) {
        this.nip = nip;
        this.username = username;
        this.foto = foto;
    }

    public String getNip() {
        return nip;
    }

    public String getUsername() {
        return username;
    }

    public String getNama(){
        return nama;
    }

    public String getJenis_kelamin() {
        return jenis_kelamin;
    }

    public String getFoto() {
        return foto;
    }

    public String getDepartment_name() {
        return department_name;
    }

    public String getPosition_in_department() {
        return position_in_department;
    }
}
