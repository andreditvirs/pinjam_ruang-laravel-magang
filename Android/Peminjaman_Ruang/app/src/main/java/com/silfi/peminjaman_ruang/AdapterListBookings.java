package com.silfi.peminjaman_ruang;

import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.bumptech.glide.Glide;
import com.bumptech.glide.load.engine.DiskCacheStrategy;
import com.bumptech.glide.load.resource.drawable.DrawableTransitionOptions;

import java.util.List;

import static com.silfi.peminjaman_ruang.Constant.URL_STORAGE;

public class AdapterListBookings extends RecyclerView.Adapter<AdapterListBookings.HolderItem> {

    List<Booking> mListBooking;
    Context context;

    public AdapterListBookings(List<Booking> mListBooking, Context context){
        this.mListBooking = mListBooking;
        this.context = context;
    }

    @NonNull
    @Override
    public HolderItem onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View layout = LayoutInflater.from(context).inflate(R.layout.beranda_row, parent, false);
        HolderItem holder = new HolderItem(layout);
        return holder;
    }

    @Override
    public void onBindViewHolder(@NonNull HolderItem holder, int position) {
        Booking booking = mListBooking.get(position);

        holder.r_nama.setText(booking.getR_nama());
        holder.u_nama.setText(booking.getU_nama());
        holder.tanggal_pinjam.setText(booking.getTanggal_pinjam());
        holder.waktu_mulai.setText(booking.getWaktu_mulai());
        holder.waktu_selesai.setText(booking.getWaktu_selesai());
    }

    @Override
    public int getItemCount() {
        return mListBooking.size();
    }

    public class HolderItem extends RecyclerView.ViewHolder{
        TextView r_nama, u_nama, tanggal_pinjam, waktu_mulai, waktu_selesai;

        public HolderItem(View v){
            super(v);
            r_nama = v.findViewById(R.id.booking_r_nama);
            u_nama = v.findViewById(R.id.booking_u_nama);
            tanggal_pinjam = v.findViewById(R.id.booking_tanggal_pinjam);
            waktu_mulai = v.findViewById(R.id.booking_waktu_mulai);
            waktu_selesai = v.findViewById(R.id.booking_waktu_selesai);
        }
    }

}
