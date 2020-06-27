package com.example.macarina_v2;

import androidx.appcompat.app.AppCompatActivity;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.ProgressBar;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.macarina_v2.configfile.ServerApi;
import com.example.macarina_v2.configfile.authdata;
import com.google.android.material.textfield.TextInputEditText;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

public class LoginActivity extends AppCompatActivity {
    TextInputEditText edtEmail, edtPassword;
    Button btnlogin;
    TextView daftar;
    ProgressBar PrgsBar;
    ProgressDialog progressDialog;
    authdata authdataa;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        progressDialog = new ProgressDialog(this);
        PrgsBar = new ProgressBar(LoginActivity.this);
        PrgsBar.setVisibility(View.GONE);
        edtEmail = findViewById(R.id.edtEmail);
        edtPassword = findViewById(R.id.edtPassword);
        daftar = findViewById(R.id.daftar_masuk);
        daftar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent regis = new Intent(LoginActivity.this , RegisterActivity.class);
                startActivity(regis);
            }
        });

        btnlogin = findViewById(R.id.buttonLogin);
        btnlogin.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if (edtEmail.getText().toString().isEmpty()){
                    Toast.makeText(LoginActivity.this, "Email Tidak Boleh Kosong", Toast.LENGTH_LONG).show();
                    progressDialog.dismiss();
                }else if (edtPassword.getText().toString().isEmpty()){
                    Toast.makeText(LoginActivity.this, "Password Tidak Boleh Kosong", Toast.LENGTH_LONG).show();
                    progressDialog.dismiss();
                }else {
                    login();
                }
            }
        });

        authdataa = new authdata(this);
        if (authdataa.isLogin() == true){
            Intent main = new Intent(LoginActivity.this, MainActivity.class);
            startActivity(main);
            finish();
        }
    }

    public void login(){
        StringRequest senddata = new StringRequest(Request.Method.POST, ServerApi.URL_LOGIN, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    progressDialog.dismiss();
                    JSONObject res = new JSONObject(response);

                    JSONObject respon = res.getJSONObject("data");
                    Toast.makeText(LoginActivity.this, respon.getString("pesan"), Toast.LENGTH_SHORT).show();
                    JSONObject datalogin = res.getJSONObject("data");
                    Log.e("ser", datalogin.getString("token"));
                    authdataa.setdatauser(
                            datalogin.getString("status"),
                            datalogin.getString("id_reseller"),
                            datalogin.getString("nama_reseller"),
                            datalogin.getString("token")
                    );
//                    nama_user = datalogin.getString("nama_reseller");
//                    Log.e("Nama" , "user" + nama_user);
//                    pd.setVisibility(View.GONE);
                    if (datalogin.getString("status").equals("1")) {
                        Log.e("ser", "sep gan");
                        Intent intent = new Intent(LoginActivity.this, MainActivity.class);
//                        intent.putExtra("Nama" , nama_user);
                        startActivity(intent);
                    } else {
                        Toast.makeText(LoginActivity.this, "Aplikasi Hanya Untuk Reseller" , Toast.LENGTH_SHORT).show();

                    }
//                    } else {
//                        Toast.makeText(LoginActivity.this, respon.getString("pesan"), Toast.LENGTH_SHORT).show();
//
//                    }

//                                pd.dismiss();

                } catch (JSONException e) {
//                                e.printStackTrace();
                    progressDialog.dismiss();
                    Log.e("errorgan", e.getMessage());
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
//                            pd.cancel();
                progressDialog.dismiss();
                Log.e("errornyaa ", "" + error);
                Toast.makeText(LoginActivity.this, "Gagal Login, " + error, Toast.LENGTH_SHORT).show();


            }
        }) {
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();
                params.put("email", edtEmail.getText().toString());
                params.put("password", edtPassword.getText().toString());

                return params;
            }
        };

        RequestQueue requestQueue = Volley.newRequestQueue(LoginActivity.this);

        requestQueue.add(senddata);
    }
}
