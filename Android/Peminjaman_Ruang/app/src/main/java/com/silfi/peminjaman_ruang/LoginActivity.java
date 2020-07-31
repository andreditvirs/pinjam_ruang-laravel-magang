package com.silfi.peminjaman_ruang;

import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.preference.PreferenceManager;
import android.text.TextUtils;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import org.json.JSONException;
import org.json.JSONObject;

import java.io.IOException;

import okhttp3.ResponseBody;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class LoginActivity extends AppCompatActivity {

    private ApiInterfaceAuth apiInterfaceAuth;
    Button btn_login;
    EditText edTxt_username, edTxt_password;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        btn_login = findViewById(R.id.btn_auth_login);
        edTxt_username = findViewById(R.id.username);
        edTxt_password = findViewById(R.id.password);

        btn_login.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if(checkEditText(edTxt_username) && checkEditText(edTxt_password)){
                    login();
                }else{
                    return;
                }
            }
        });
    }

    private boolean checkEditText(EditText edTxt){
        String check = edTxt.getText().toString().trim();
        if(TextUtils.isEmpty(check)){
            edTxt.setError("Silahkan masukkan Username");
            edTxt.requestFocus();
            return false;
        }else{
            return true;
        }
    }

    private void login(){
        String username = edTxt_username.getText().toString();
        String password = edTxt_password.getText().toString();

        apiInterfaceAuth = ApiClientAuth.getApiClient().create(ApiInterfaceAuth.class);
        Call<ResponseBody> call = apiInterfaceAuth.login(username, password);
        call.enqueue(new Callback<ResponseBody>() {
            @Override
            public void onResponse(Call<ResponseBody> call, Response<ResponseBody> response) {
                if (response.isSuccessful()){
                    try {
                        JSONObject jsonObject = new JSONObject(response.body().string());
                        if(!jsonObject.getBoolean("error")){
                            String token = jsonObject.getJSONObject("success").getString("token");
                            SharedPreferences prefs = PreferenceManager.getDefaultSharedPreferences(LoginActivity.this);
                            SharedPreferences.Editor editor = prefs.edit();
                            editor.putString("access_token", token);
                            editor.commit();
                            Intent i = new Intent(LoginActivity.this, HomeActivity.class);
                            finish();
                            startActivity(i);
                        }else{
                            Toast.makeText(LoginActivity.this, "Username/Password Anda salah", Toast.LENGTH_SHORT).show();
                        }
                    }catch (JSONException e){
                        e.printStackTrace();
                    }catch (IOException e){
                        e.printStackTrace();
                    }
                }else{
                    Toast.makeText(LoginActivity.this, "Pastikan Anda terhubung dengan internet", Toast.LENGTH_SHORT).show();
                }
            }

            @Override
            public void onFailure(Call<ResponseBody> call, Throwable t) {

            }
        });
        edTxt_username.setText("");
        edTxt_password.setText("");
    }
}

