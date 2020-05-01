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
    EditText Nama, Email, Password, UlangiPassword, NoTelepon;
    Button btn_daftar;
    RequestQueue requestQueue;
    String NamaHolder, EmailHolder, PasswordHolder, UlangiPasswordHolder, NoTeleponHolder;
    ProgressDialog progressDialog;
    String HttpUrl = "http://192.168.1.4/macarinamobile/register.php";
    Boolean CheckEditText;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_register);
        // Assigning ID's to EditText.
        Nama = (EditText) findViewById(R.id.nama);

        Email = (EditText) findViewById(R.id.email);

        Password = (EditText) findViewById(R.id.password1);
        UlangiPassword = (EditText) findViewById(R.id.password2);
        NoTelepon = (EditText) findViewById(R.id.NoTelepon);

        // Assigning ID's to Button.
        masuk = (Button) findViewById(R.id.btn_daftar);

        // Creating Volley newRequestQueue .
        requestQueue = Volley.newRequestQueue(RegisterActivity.this);

        // Assigning Activity this to progress dialog.
        progressDialog = new ProgressDialog(RegisterActivity.this);

        masuk = findViewById(R.id.tmasuk);
        masuk.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent masuk = new Intent(RegisterActivity.this , LoginActivity.class);
                startActivity(masuk);

                CheckEditTextIsEmptyOrNot();
                if(CheckEditText){
                    UserRegistration();
                }
                else {
                    Toast.makeText(RegisterActivity.this, "Please fill all form fields.", Toast.LENGTH_LONG).show();
                }

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
                params.put("Email", EmailHolder);
                params.put("Password", PasswordHolder);
                params.put("Nama", NamaHolder);
                params.put("UlangiPassword", UlangiPasswordHolder);
                params.put("NoTelepon", NoTeleponHolder);
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
        NoTeleponHolder = NoTelepon.getText().toString().trim();

        // Checking whether EditText value is empty or not.
        if(TextUtils.isEmpty(NamaHolder) || TextUtils.isEmpty(EmailHolder) || TextUtils.isEmpty(PasswordHolder)|| TextUtils.isEmpty(UlangiPasswordHolder) || TextUtils.isEmpty(NoTeleponHolder))
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


