package com.example.macarina_v2;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.text.TextUtils;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.google.android.material.textfield.TextInputEditText;

import java.util.HashMap;
import java.util.Map;

public class LoginActivity extends AppCompatActivity {
    String url= "http://192.168.100.6/Luqman/Macarina_v.2/web/android.php";
    TextInputEditText email, password;
    Button btnlogin;
    String eml, pw;
    Boolean cekinput;
    TextView daftar;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        email = findViewById(R.id.edtEmail);
        password = findViewById(R.id.edtPassword);
        btnlogin = findViewById(R.id.buttonLogin);
        btnlogin.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                cekEditText();
                if(cekinput){
                    ceklogin();
                }else{
                    Toast.makeText(LoginActivity.this, "Masukkan Email dan Password", Toast.LENGTH_LONG).show();
                }
            }
        });

        daftar = findViewById(R.id.daftar_masuk);
        daftar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent regis = new Intent(LoginActivity.this , RegisterActivity.class);
                startActivity(regis);
            }
        });
    }

    public void ceklogin(){
        StringRequest stringRequest = new StringRequest(Request.Method.POST, url,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String ServerResponse) {
                        if (ServerResponse.equalsIgnoreCase("ada")) {
                            Toast.makeText(LoginActivity.this, "Selamat Datang", Toast.LENGTH_LONG).show();
                            finish();
                            Intent intent = new Intent(LoginActivity.this, HomeFragment.class);
                            intent.putExtra("email", eml);
                            startActivity(intent);
                        } else {
                            Toast.makeText(LoginActivity.this, ServerResponse, Toast.LENGTH_LONG).show();
                        }
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Toast.makeText(LoginActivity.this, error.toString(), Toast.LENGTH_SHORT).show();
                    }
                }){
            @Override
            protected Map<String, String> getParams(){
                Map<String, String>  params = new HashMap<>();
                params.put("email", eml);
                params.put("password",pw);
                return params;
            }
        };
        RequestQueue requestQueue = Volley.newRequestQueue(LoginActivity.this);
        requestQueue.add(stringRequest);
    }

    public void cekEditText(){
        eml =email.getText().toString().trim();
        pw = password.getText().toString().trim();

        if(TextUtils.isEmpty(eml) || TextUtils.isEmpty(pw)){
            cekinput = false;
        }else {
            cekinput = true;
        }
    }

}
