package com.silfi.peminjaman_ruang;

import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;

import static com.silfi.peminjaman_ruang.Constant.BASE_API;

public class ApiClientAuth {
    private static Retrofit retrofit = null;

    public static Retrofit getApiClient(){
        if (retrofit == null){
            retrofit = new Retrofit
                    .Builder()
                    .baseUrl(BASE_API)
                    .addConverterFactory(GsonConverterFactory.create())
                    .build();
        }
        return retrofit;
    }
}
