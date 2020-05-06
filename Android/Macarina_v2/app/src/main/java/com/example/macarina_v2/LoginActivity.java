package com.example.macarina_v2;

import androidx.appcompat.app.AppCompatActivity;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.text.TextUtils;
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
    String url= "http://192.168.100.6/Luqman/Macarina_v.2/web/android.php";
    TextInputEditText edtEmail, edtPassword;
    Button btnlogin;
    String eml, pw;
    Boolean cekinput;
    TextView daftar;
    ProgressBar PrgsBar;
    ProgressDialog progressDialog;
    String nama_user;
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
                progressDialog.setMessage("Tunggu Beberapa Saat");
                progressDialog.show();
                PrgsBar.setVisibility(View.VISIBLE);
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
                    authdata.getInstance(getApplicationContext()).setdatauser(
                            datalogin.getString("status"),
                            datalogin.getString("id_registrasi"),
                            datalogin.getString("nama"),
                            datalogin.getString("token")
                    );
                    Intent masuk = new Intent(LoginActivity.this , MainActivity.class);
//                                    startActivity(masuk);
                    nama_user = datalogin.getString("nama");
                    Log.e("Nama" , "user" + nama_user);
                    PrgsBar.setVisibility(View.GONE);
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
