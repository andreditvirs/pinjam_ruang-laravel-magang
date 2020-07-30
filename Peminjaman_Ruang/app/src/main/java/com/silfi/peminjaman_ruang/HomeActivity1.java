package com.silfi.peminjaman_ruang;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import android.content.SharedPreferences;
import android.os.Bundle;
import android.preference.PreferenceManager;
import android.util.Log;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

import static com.silfi.peminjaman_ruang.Constant.*;

public class HomeActivity1 extends AppCompatActivity {

    RecyclerView mRecyclerView;
    RecyclerView.Adapter mAdapter;
    RecyclerView.LayoutManager mManager;
    RequestQueue mRequest;
    List<Room> lRooms = new ArrayList<>();

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.fragment_home);

        mRecyclerView = (RecyclerView) findViewById(R.id.rcV_rooms);
        mManager = new LinearLayoutManager(this, LinearLayoutManager.VERTICAL,false);
        request();
        mRecyclerView.setLayoutManager(mManager);
        mAdapter =  new AdapterListRooms(lRooms, this);
        mRecyclerView.setAdapter(mAdapter);
    }

    private void request(){
        lRooms.clear();
        JsonObjectRequest requestRooms = new JsonObjectRequest(Request.Method.GET, API_LIST_ROOMS, null,
                new Response.Listener<JSONObject>() {
                    @Override
                    public void onResponse(JSONObject object) {
                        Log.d("JSONObject===", object.toString());
                        try{
                            if(!object.getBoolean("error")){
                                JSONArray rooms = object.getJSONArray("rooms");
                                for (int i = 0; i < rooms.length(); i++) {
                                    JSONObject obj = rooms.getJSONObject(i);
                                    lRooms.add(new Room(
                                            obj.getInt("id"),
                                            obj.getString("nama"),
                                            obj.getString("foto")
                                    ));
                                }
                            }
                        }catch (JSONException e){
                            e.printStackTrace();
                        }
                        mAdapter.notifyDataSetChanged();
                    }
                }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Log.d("ERRORRequest", "Error : " + error.getMessage());
            }
        }){
            @Override
            public Map<String, String> getHeaders() throws AuthFailureError {
                SharedPreferences prefs = PreferenceManager.getDefaultSharedPreferences(HomeActivity1.this);
                Map<String, String> params = new HashMap<String, String>();
                params.put("Content-Type", "application/json; charset=UTF-8");
                params.put("Authorization", "Bearer "+ prefs.getString("access_token", null));
                return params;
            }
        };
        mRequest = Volley.newRequestQueue(this);
        mRequest.add(requestRooms);
    }
}