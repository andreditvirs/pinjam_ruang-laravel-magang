package com.silfi.peminjaman_ruang;

import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;
import androidx.core.content.ContextCompat;

import android.content.SharedPreferences;
import android.graphics.Color;
import android.graphics.drawable.Drawable;
import android.os.Bundle;
import android.preference.PreferenceManager;
import android.util.Log;
import android.view.View;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.ProgressBar;
import android.widget.TextView;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.Volley;
import com.bumptech.glide.Glide;
import com.bumptech.glide.load.DataSource;
import com.bumptech.glide.load.engine.GlideException;
import com.bumptech.glide.request.RequestListener;
import com.bumptech.glide.request.target.Target;
import com.google.android.material.appbar.CollapsingToolbarLayout;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

import static com.silfi.peminjaman_ruang.Constant.API_LIST_BOOKINGS;
import static com.silfi.peminjaman_ruang.Constant.API_LIST_ROOMS;

public class RoomDetailActivity extends AppCompatActivity {

    private ApiInterfaceAuth apiInterface;
    private ImageView foto;
    private TextView fasilitas, kapasitas, lantai;
    private TextView nip_peminjam, nama_peminjam, tanggal_mulai_peminjaman, tanggal_selesai_peminjaman, keperluan_peminjam;
    private TextView status_ruangan;
    Room room;
    RequestQueue mRequest;
    CollapsingToolbarLayout collapsingToolbarLayout;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_room_detail);
        Bundle bundle = getIntent().getExtras();
        int id = bundle.getInt("id");

        Toolbar toolbar = findViewById(R.id.toolbar_room_detail);
        setSupportActionBar(toolbar);
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);

        collapsingToolbarLayout = findViewById(R.id.collapsing);
        collapsingToolbarLayout.setExpandedTitleColor(Color.parseColor("#44ffffff"));
        fasilitas = findViewById(R.id.room_fasilitas);
        kapasitas = findViewById(R.id.room_kapasitas);
        lantai = findViewById(R.id.room_lantai);
        foto = findViewById(R.id.room_foto);

        requestRoomDetail(id);
    }

    private void requestRoomDetail(int id){
        JsonObjectRequest requestRooms = new JsonObjectRequest(Request.Method.GET, API_LIST_ROOMS+"/"+id, null,
                new com.android.volley.Response.Listener<JSONObject>() {
                    @Override
                    public void onResponse(JSONObject object) {
                        try{
                            if(!object.getBoolean("error")){
                                JSONObject rooms = object.getJSONObject("room");
                                room = new Room(rooms.getInt("id"),
                                        rooms.getString("nama"),
                                        rooms.getString("lantai"),
                                        rooms.getString("kapasitas"),
                                        rooms.getString("fasilitas"),
                                        rooms.getString("foto"));
                                setRoomDetail(room);
                            }
                        }catch (JSONException e){
                            e.printStackTrace();
                        }
                    }
                }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Log.d("ERRORRequest", "Error : " + error.getMessage());
            }
        }){
            @Override
            public Map<String, String> getHeaders() throws AuthFailureError {
                SharedPreferences prefs = PreferenceManager.getDefaultSharedPreferences(RoomDetailActivity.this);
                Map<String, String> params = new HashMap<String, String>();
                params.put("Content-Type", "application/json; charset=UTF-8");
                params.put("Authorization", "Bearer "+ prefs.getString("access_token", null));
                return params;
            }
        };
        mRequest = Volley.newRequestQueue(RoomDetailActivity.this);
        mRequest.add(requestRooms);
    }

    public void setRoomDetail(Room room){
        collapsingToolbarLayout.setTitle(room.getNama());
        lantai.setText(room.getLantai());
        fasilitas.setText(room.getFasilitas());
        kapasitas.setText(room.getKapasitas());
        Glide.with(this)
                .load(Constant.URL_STORAGE+room.getFoto())
                .placeholder(R.drawable.jatim)
                .error(R.drawable.jatim)
                .listener(new RequestListener<Drawable>() {
                    @Override
                    public boolean onLoadFailed(@Nullable GlideException e, Object model, Target<Drawable> target, boolean isFirstResource) {
                        return false;
                    }

                    @Override
                    public boolean onResourceReady(Drawable resource, Object model, Target<Drawable> target, DataSource dataSource, boolean isFirstResource) {
                        return false;
                    }
                })
                .override(400, 600)
                .fitCenter() // scale to fit entire image within ImageView
                .into(foto);
    }
}