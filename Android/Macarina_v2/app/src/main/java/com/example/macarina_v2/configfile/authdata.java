package com.example.macarina_v2.configfile;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;

import com.example.macarina_v2.LoginActivity;
import com.example.macarina_v2.MainActivity;

public class authdata {
//    private static authdata mInstance;
    SharedPreferences sharedPreferences;
    public Context mCtx;

    public static final String SHARED_PREF_NAME = "macarina_v.2";
    private static final String sudahlogin = "n";
    public SharedPreferences.Editor editor;

    private static final String kode_user = "id_reseller";
    private static final String nama_user = "nama_reseller";
    private static final String akses_data = "akses_data";
    private static final String foto_user = "pas_foto";
    private static final String status_user = "status";
    private static final String token = "token";
    public static final String LOGIN_STATUS = "LOGIN_STATUS";



    public authdata(Context context){
        this.mCtx = context;
        sharedPreferences = context.getSharedPreferences(SHARED_PREF_NAME, Context.MODE_PRIVATE);
        editor = sharedPreferences.edit();
    }

    public void setdatauser(String xstatus, String xkode_user, String xnama_user, String tokennya, String xfoto){
//        sharedPreferences = mCtx.getSharedPreferences(SHARED_PREF_NAME, Context.MODE_PRIVATE);
//        editor = sharedPreferences.edit();

        editor.putBoolean(LOGIN_STATUS, true);
        editor.putString(kode_user, xkode_user);
        editor.putString(nama_user, xnama_user);
        editor.putString(status_user, xstatus);
        editor.putString(sudahlogin, "y");
        editor.putString(token, tokennya);
        editor.putString(foto_user, xfoto);
        editor.apply();
    }




    public boolean isLogin(){
        return sharedPreferences.getBoolean(LOGIN_STATUS, false);
    }

    public void logout(){
        editor.clear();
        editor.commit();

        Intent login = new Intent(mCtx, LoginActivity.class);
        mCtx.startActivity(login);
        ((MainActivity)mCtx).finish();
    }

    public String getToken() {
        return sharedPreferences.getString(token, null);
    }
    public String getAksesData() {
        return sharedPreferences.getString(akses_data, null);
    }

    public String getKodeUser() {
        return sharedPreferences.getString(kode_user, null);
    }
    public String getNamaUser() {
        return sharedPreferences.getString(nama_user, null);
    }
    public String getFoto_user() {
        return sharedPreferences.getString(foto_user, null);
    }

}
