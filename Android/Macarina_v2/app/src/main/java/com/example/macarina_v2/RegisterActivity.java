package com.example.macarina_v2;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ProgressBar;
import android.widget.TextView;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.macarina_v2.configfile.ServerApi;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

public class RegisterActivity extends AppCompatActivity {
    TextView masuk;
    EditText nama, password, password2, email, no_telepon;
    Button buttonDaftar;
    Boolean CheckEditText;
    String NameHolder, EmailHolder, PasswordHolder, NoTlpHolder, PasswordHolder2;
    ProgressDialog progressDialog;
    RequestQueue requestQueue;
    ProgressBar progressBar;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_register);
        nama = findViewById(R.id.nama);
        email = findViewById(R.id.email);
        password = findViewById(R.id.password1);
        password2 = findViewById(R.id.password2);
        no_telepon = findViewById(R.id.no_telepon);
        requestQueue = Volley.newRequestQueue(RegisterActivity.this);
        progressDialog = new ProgressDialog(this);
        progressBar = new ProgressBar(RegisterActivity.this);

        buttonDaftar = findViewById(R.id.buttonDaftar);
        buttonDaftar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                UserRegistration();
            }
        });

        masuk = findViewById(R.id.tmasuk);
        masuk.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent masuk = new Intent(RegisterActivity.this , LoginActivity.class);
                startActivity(masuk);
            }
        });
    }

    public void UserRegistration() {
        final String nama_reseller = this.nama.getText().toString().trim();
        final String email = this.email.getText().toString().trim();
        final String no_tlp = this.no_telepon.getText().toString().trim();
        final String password = this.password.getText().toString().trim();

        if (nama_reseller.matches("")){
            Toast.makeText(this, "Masukkan Nama Anda", Toast.LENGTH_SHORT).show();
            return;
        }
        if (email.matches("")){
            Toast.makeText(this, "Masukkan email Anda", Toast.LENGTH_SHORT).show();
            return;
        }
        if (no_tlp.matches("")){
            Toast.makeText(this, "Masukkan No Telpon Anda", Toast.LENGTH_SHORT).show();
            return;
        }
        if (password.matches("")){
            Toast.makeText(this, "Masukkan password Anda", Toast.LENGTH_SHORT).show();
            return;
        }

        progressBar.setVisibility(View.GONE);
        masuk.setVisibility(View.GONE);

        StringRequest stringRequest = new StringRequest(Request.Method.POST, ServerApi.URL_REGIS,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        try {
                            JSONObject jsonObject = new JSONObject(response);
                            String status = jsonObject.getString("status");
                            String error = jsonObject.getString("error");
                            String message = jsonObject.getString("message");

                            if (status.equals("200") && error.equals("false")) {
                                Toast.makeText(RegisterActivity.this, message, Toast.LENGTH_SHORT).show();
                                new Handler().postDelayed(new Runnable() {
                                    @Override
                                    public void run() {
                                        Intent intent2 = new Intent(RegisterActivity.this, LoginActivity.class);
                                        startActivity(intent2);
                                    }
                                }, 1500);
                            } else {
                                Toast.makeText(RegisterActivity.this, message, Toast.LENGTH_SHORT).show();
                                progressBar.setVisibility(View.GONE);
                                masuk.setVisibility(View.VISIBLE);
                            }
                        } catch (JSONException e) {
                            e.printStackTrace();
                            progressBar.setVisibility(View.GONE);
                            Intent intent3 = new Intent(RegisterActivity.this, LoginActivity.class);
                            startActivity(intent3);
                            Toast.makeText(RegisterActivity.this, "Registrasi Berhasil", Toast.LENGTH_SHORT).show();
                        }
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Toast.makeText(RegisterActivity.this, "Error! " + error.toString(), Toast.LENGTH_SHORT).show();
                        progressBar.setVisibility(View.GONE);
                        masuk.setVisibility(View.VISIBLE);
                    }
                })
        {
            protected Map<String, String> getParams() {
                Map<String, String> params = new HashMap<>();
                params.put("nama_reseller",nama_reseller);
                params.put("email",email);
                params.put("no_tlp",no_tlp);
                params.put("password",password);
                return params;
            }
        };

        RequestQueue requestQueue = Volley.newRequestQueue(this);
        requestQueue.add(stringRequest);
    }
}