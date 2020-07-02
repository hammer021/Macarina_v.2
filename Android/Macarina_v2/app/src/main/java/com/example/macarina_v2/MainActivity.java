package com.example.macarina_v2;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import androidx.fragment.app.Fragment;

import android.app.ProgressDialog;
import android.os.Bundle;
import android.view.MenuItem;

import com.android.volley.AuthFailureError;
import com.android.volley.ClientError;
import com.android.volley.NetworkError;
import com.android.volley.NoConnectionError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.TimeoutError;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.example.macarina_v2.configfile.ServerApi;
import com.example.macarina_v2.configfile.authdata;
import com.google.android.material.bottomnavigation.BottomNavigationView;
import com.google.android.material.snackbar.Snackbar;

import org.json.JSONArray;
import org.json.JSONObject;

public class MainActivity extends AppCompatActivity {
    String mIdReseller;
    authdata authdataa;
    String mFotoProfil;

    ProgressDialog progressDialog;
    private RequestQueue queue;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        authdataa = new authdata(this);
        mIdReseller = authdataa.getKodeUser();

        BottomNavigationView bottomNav = findViewById(R.id.bottom_navigation);
        bottomNav.setOnNavigationItemSelectedListener(navListener);

        getSupportFragmentManager().beginTransaction().replace(R.id.fragment_container, new HomeFragment()).commit();
    }

    private BottomNavigationView.OnNavigationItemSelectedListener navListener =
            new BottomNavigationView.OnNavigationItemSelectedListener() {
                @Override
                public boolean onNavigationItemSelected(@NonNull MenuItem item) {

                    Fragment selectedFragment = null;

                    switch (item.getItemId()) {
                        case R.id.nav_home:
                            selectedFragment = new HomeFragment();
                            break;
                        case R.id.nav_tentang:
                            selectedFragment = new AboutFragment();
                            break;
                        case R.id.nav_akun:
                            selectedFragment = new AkunFragment();
                            break;
                    }

                    getSupportFragmentManager().beginTransaction().replace(R.id.fragment_container, selectedFragment).commit();

                    //return false;
                    return true;
                }
            };

//    private void _loadInfo() {
//        progressDialog.setMessage("Sedang Memperbarui Data...");
//        progressDialog.setCancelable(false);
//        progressDialog.show();
//
//        String url = ServerApi.URL_USER + mIdReseller;
//
//        StringRequest stringRequest = new StringRequest(Request.Method.GET, url, new Response.Listener<String>() {
//            @Override
//            public void onResponse(String response) {
//                progressDialog.dismiss();
//                try {
//                    JSONObject jsonObject = new JSONObject(response);
//                    String status = jsonObject.getString("status");
//
//                    if (status == "false") {
//                        Snackbar.make(findViewById(R.id.main_activity), "Terjadi Kesalahan", Snackbar.LENGTH_LONG).show();
//                    } else {
//                        JSONObject infoKost = jsonObject.getJSONObject("data");
//                        mFotoProfil = infoKost.getString("foto_kost");
//
//                        Fragment fragment = AkunFragment.newInstance(mFotoProfil);
//                        getSupportFragmentManager().beginTransaction().replace(R.id.fragment_container, fragment).commit();
//                    }
//                } catch (Exception e) {
//                    Snackbar.make(findViewById(R.id.main_activity), e.toString(), Snackbar.LENGTH_LONG).show();
//                }
//            }
//        }, new Response.ErrorListener() {
//            @Override
//            public void onErrorResponse(VolleyError error) {
//                progressDialog.dismiss();
//                String message = "Terjadi error. Coba beberapa saat lagi.";
//
//                if (error instanceof NetworkError){
//                    message = "Tidak dapat terhubung ke internet. Harap periksa koneksi anda.";
//                } else if (error instanceof AuthFailureError) {
//                    message = "Gagal login. Harap periksa email dan password anda.";
//                } else if (error instanceof ClientError) {
//                    message = "Gagal login. Harap periksa email dan password anda.";
//                } else if (error instanceof NoConnectionError){
//                    message = "Tidak ada koneksi internet. Harap periksa koneksi anda.";
//                } else if (error instanceof TimeoutError){
//                    message = "Connection Time Out. Harap periksa koneksi anda.";
//                }
//
//                Snackbar.make(findViewById(R.id.main_activity), message, Snackbar.LENGTH_LONG).show();
//            }
//        });
//
//        queue.add(stringRequest);
//    }
}
