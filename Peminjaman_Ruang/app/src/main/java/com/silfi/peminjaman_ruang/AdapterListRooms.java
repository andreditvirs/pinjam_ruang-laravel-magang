package com.silfi.peminjaman_ruang;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.bumptech.glide.Glide;
import com.bumptech.glide.load.engine.DiskCacheStrategy;
import com.bumptech.glide.load.resource.drawable.DrawableTransitionOptions;

import java.util.List;

import static com.silfi.peminjaman_ruang.Constant.URL_STORAGE;

public class AdapterListRooms extends RecyclerView.Adapter<AdapterListRooms.HolderItem> {

    List<Room> mListRoom;
    Context context;

    public AdapterListRooms(List<Room> mListRoom, Context context){
        this.mListRoom = mListRoom;
        this.context = context;
    }

    @NonNull
    @Override
    public HolderItem onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View layout = LayoutInflater.from(context).inflate(R.layout.beranda_rows, parent, false);
        HolderItem holder = new HolderItem(layout);
        return holder;
    }

    @Override
    public void onBindViewHolder(@NonNull HolderItem holder, int position) {
        Room room = mListRoom.get(position);

        holder.tv_nama.setText(room.getNama());
//        holder.tv_nrp.setText(room.getNrp());

        // Loading Image
        Glide.with(context).load(URL_STORAGE + room.getFoto()).thumbnail(0.5f).transition(new DrawableTransitionOptions().crossFade()).diskCacheStrategy(DiskCacheStrategy.ALL).into(holder.thumbnail);
    }

    @Override
    public int getItemCount() {
        return mListRoom.size();
    }

    public class HolderItem extends RecyclerView.ViewHolder{
        ImageView thumbnail;
        TextView tv_nama, tv_nrp;

        public HolderItem(View v){
            super(v);
            thumbnail = (ImageView) v.findViewById(R.id.img_cover);
            tv_nama = (TextView) v.findViewById(R.id.tv_nama);
//            tv_nrp = (TextView) v.findViewById(R.id.tv_nrp);
        }
    }

}
