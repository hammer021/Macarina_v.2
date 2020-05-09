package com.example.macarina_v2;

import androidx.appcompat.app.AppCompatActivity;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.text.TextUtils;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import java.util.HashMap;
import java.util.Map;

public class RegisterActivity extends AppCompatActivity {
    TextView masuk;
    EditText Nama, Email, Password, UlangiPassword, Telpon;
    Button daftar;
    RequestQueue requestQueue;
    String NamaHolder, EmailHolder, PasswordHolder, UlangiPasswordHolder, TelponHolder;
    ProgressDialog progressDialog;
    String HttpUrl = "http://192.168.1.9/Macarina_v.2/web/register.php";
    Boolean CheckEditText;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_register);
        masuk = findViewById(R.id.tmasuk);
        Nama = (EditText) findViewById(R.id.nama);
        Email = (EditText) findViewById(R.id.email);
        Password = (EditText) findViewById(R.id.password1);
        UlangiPassword = (EditText) findViewById(R.id.password2);
        Telpon = (EditText) findViewById(R.id.NoTelepon);
        daftar = (Button) findViewById(R.id.btn_daftar);
        masuk = (TextView) findViewById(R.id.tmasuk);

        // Creating Volley newRequestQueue .
        requestQueue = Volley.newRequestQueue(RegisterActivity.this);

        // Assigning Activity this to progress dialog.
        progressDialog = new ProgressDialog(RegisterActivity.this);

        daftar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                CheckEditTextIsEmptyOrNot();
                if(CheckEditText){
                    UserRegistration();
                }
                else {
                    Toast.makeText(RegisterActivity.this, "Data tidak boleh kosong!", Toast.LENGTH_LONG).show();
                }

            }
        });
        masuk.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent masuk = new Intent(RegisterActivity.this , LoginActivity.class);
                startActivity(masuk);
            }
        });
    }
    public void UserRegistration(){

        // Showing progress dialog at user registration time.
        progressDialog.setMessage("Please Wait, We are Inserting Your Data on Server");
        progressDialog.show();

        // Creating string request with post method.
        StringRequest stringRequest = new StringRequest(Request.Method.POST, HttpUrl,
                new Response.Listener<String>() {

                    @Override
                    public void onResponse(String ServerResponse) {

                        // Hiding the progress dialog after all task complete.
                        progressDialog.dismiss();

                        // Showing Echo Response Message Coming From Server.
                        Toast.makeText(RegisterActivity.this, ServerResponse, Toast.LENGTH_LONG).show();
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError volleyError) {

                        // Hiding the progress dialog after all task complete.
                        progressDialog.dismiss();

                        // Showing error message if something goes wrong.
                        Toast.makeText(RegisterActivity.this, volleyError.toString(), Toast.LENGTH_LONG).show();
                    }
                }) {
            @Override
            protected Map<String, String> getParams() {

                // Creating Map String Params.
                Map<String, String> params = new HashMap<String, String>();

                // Adding All values to Params.
                // The firs argument should be same as your MySQL database table columns.
                params.put("email", EmailHolder);
                params.put("password", PasswordHolder);
                params.put("nama", NamaHolder);
                params.put("ulangi_password", UlangiPasswordHolder);
                params.put("telpon", TelponHolder);
                return params;
            }
        };
        // Creating RequestQueue.
        RequestQueue requestQueue = Volley.newRequestQueue(RegisterActivity.this);

        // Adding the StringRequest object into requestQueue.
        requestQueue.add(stringRequest);

    }


    public void CheckEditTextIsEmptyOrNot(){

        // Getting values from EditText.
        NamaHolder = Nama.getText().toString().trim();
        EmailHolder = Email.getText().toString().trim();
        PasswordHolder = Password.getText().toString().trim();
        UlangiPasswordHolder = UlangiPassword.getText().toString().trim();
        TelponHolder = Telpon.getText().toString().trim();

        // Checking whether EditText value is empty or not.
        if(TextUtils.isEmpty(NamaHolder) || TextUtils.isEmpty(EmailHolder) || TextUtils.isEmpty(PasswordHolder)|| TextUtils.isEmpty(UlangiPasswordHolder) || TextUtils.isEmpty(TelponHolder))
        {

            // If any of EditText is empty then set variable value as False.
            CheckEditText = false;

        }
        else {

            // If any of EditText is filled then set variable value as True.
            CheckEditText = true ;
        }
    }

}