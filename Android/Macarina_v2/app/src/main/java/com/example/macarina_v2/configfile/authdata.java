package com.example.macarina_v2.configfile;

import android.content.Context;
import android.content.SharedPreferences;

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
    private static final String status_user = "status";
    private static final String token = "token";
    public static final String LOGIN_STATUS = "LOGIN_STATUS";



    public authdata(Context context){
        this.mCtx = context;
        sharedPreferences = context.getSharedPreferences(SHARED_PREF_NAME, Context.MODE_PRIVATE);
        editor = sharedPreferences.edit();
    }

    public void setdatauser(String xstatus, String xkode_user, String xnama_user, String tokennya){
//        sharedPreferences = mCtx.getSharedPreferences(SHARED_PREF_NAME, Context.MODE_PRIVATE);
//        editor = sharedPreferences.edit();

        editor.putBoolean(LOGIN_STATUS, true);
        editor.putString(kode_user, xkode_user);
        editor.putString(nama_user, xnama_user);
        editor.putString(status_user, xstatus);
        editor.putString(sudahlogin, "y");
        editor.putString(token, tokennya);
        editor.apply();
    }




    public boolean isLogin(){
        return sharedPreferences.getBoolean(LOGIN_STATUS, false);
    }

    public boolean logout(){
        SharedPreferences sharedPreferences = mCtx.getSharedPreferences(SHARED_PREF_NAME, Context.MODE_PRIVATE);
        SharedPreferences.Editor editor = sharedPreferences.edit();
        editor.clear();
        editor.apply();
        return true;
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
}
