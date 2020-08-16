package com.silfi.peminjaman_ruang.profile;

import android.content.Intent;
import android.content.SharedPreferences;
import android.graphics.drawable.Drawable;
import android.os.Bundle;
import android.preference.PreferenceManager;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.ProgressBar;
import android.widget.TextView;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.fragment.app.Fragment;

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
import com.silfi.peminjaman_ruang.Constant;
import com.silfi.peminjaman_ruang.LoginActivity;
import com.silfi.peminjaman_ruang.Profile;
import com.silfi.peminjaman_ruang.R;
import com.silfi.peminjaman_ruang.Room;
import com.silfi.peminjaman_ruang.RoomDetailActivity;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

import static com.silfi.peminjaman_ruang.Constant.API_LIST_ROOMS;
import static com.silfi.peminjaman_ruang.Constant.API_USER_AUTH;

public class ProfileFragment extends Fragment {

    RequestQueue mRequest;
    TextView nip, username, nama, jenis_kelamin, department_name, position_in_department_name;
    ImageView foto;
    Button btn_logout;
    ProgressBar mProgressBar;

    public View onCreateView(@NonNull LayoutInflater inflater,
                             ViewGroup container, Bundle savedInstanceState) {
        View root = inflater.inflate(R.layout.fragment_profile, container, false);
        mProgressBar = root.findViewById(R.id.progressBar_profile);
        mProgressBar.setVisibility(View.VISIBLE);

        nip = root.findViewById(R.id.txtV_profile_nip);
        username = root.findViewById(R.id.txtV_profile_username);
        nama = root.findViewById(R.id.txtV_profile_nama);
        department_name = root.findViewById(R.id.txtV_profile_bidang);
        position_in_department_name = root.findViewById(R.id.txtV_profile_jabatan);
        foto = root.findViewById(R.id.profile_foto);
        btn_logout = root.findViewById(R.id.btn_logout);

        request();

        btn_logout.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                logout();
            }
        });
        return root;
    }

    private void logout(){
        JsonObjectRequest requestRooms = new JsonObjectRequest(Request.Method.POST, API_USER_AUTH+"/logout", null,
                new com.android.volley.Response.Listener<JSONObject>() {
                    @Override
                    public void onResponse(JSONObject object) {
                        try{
                            if(!object.getBoolean("error")){
                                Toast.makeText(getActivity(), "Anda berhasil logout", Toast.LENGTH_SHORT).show();
                                startActivity(new Intent(getActivity(), LoginActivity.class));
                            }else{
                                Toast.makeText(getActivity(), "Koneksi bermasalah, harap ulangi", Toast.LENGTH_SHORT).show();
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
                SharedPreferences prefs = PreferenceManager.getDefaultSharedPreferences(getActivity());
                Map<String, String> params = new HashMap<String, String>();
                params.put("Content-Type", "application/json; charset=UTF-8");
                params.put("Authorization", "Bearer "+ prefs.getString("access_token", null));
                return params;
            }
        };
        mRequest = Volley.newRequestQueue(getActivity());
        mRequest.add(requestRooms);
    }

    private void request(){
        JsonObjectRequest requestRooms = new JsonObjectRequest(Request.Method.POST, API_USER_AUTH+"/details", null,
                new com.android.volley.Response.Listener<JSONObject>() {
                    @Override
                    public void onResponse(JSONObject object) {
                        try{
                            mProgressBar.setVisibility(View.INVISIBLE);
                            JSONObject profiles = object.getJSONObject("profile");
                            Profile profile = new Profile(profiles.getString("nip"),
                                    profiles.getString("username"),
                                    profiles.getString("nama"),
                                    profiles.getString("jenis_kelamin"),
                                    profiles.getString("foto"),
                                    profiles.getString("department_name"),
                                    profiles.getString("position_in_department_name"));
                            setProfile(profile);
                        }catch (JSONException e){
                            e.printStackTrace();
                        }
                    }
                }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                mProgressBar.setVisibility(View.INVISIBLE);
                Log.d("ERRORRequest", "Error : " + error.getMessage());
            }
        }){
            @Override
            public Map<String, String> getHeaders() throws AuthFailureError {
                SharedPreferences prefs = PreferenceManager.getDefaultSharedPreferences(getActivity());
                Map<String, String> params = new HashMap<String, String>();
                params.put("Content-Type", "application/json; charset=UTF-8");
                params.put("Authorization", "Bearer "+ prefs.getString("access_token", null));
                return params;
            }
        };
        mRequest = Volley.newRequestQueue(getActivity());
        mRequest.add(requestRooms);
    }

    public void setProfile(Profile profile){
        nip.setText(profile.getNip());
        username.setText(profile.getUsername());
        nama.setText(profile.getNama());
        department_name.setText(profile.getDepartment_name());
        position_in_department_name.setText(profile.getPosition_in_department());
        System.out.println("PROFILE==="+Constant.URL_STORAGE+profile.getFoto());
        Glide.with(this)
                .load(Constant.URL_STORAGE+profile.getFoto())
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