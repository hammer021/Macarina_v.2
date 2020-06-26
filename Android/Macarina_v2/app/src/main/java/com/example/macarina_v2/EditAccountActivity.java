package com.example.macarina_v2;

import androidx.appcompat.app.AppCompatActivity;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;

import com.android.volley.RequestQueue;
import com.android.volley.toolbox.Volley;
import com.example.macarina_v2.configfile.authdata;

public class EditAccountActivity extends AppCompatActivity {
    ProgressDialog progressDialog;
    authdata authdataa;
    RequestQueue queue;
    ArrayAdapter<String> adapter;

    String mIdReseller;
    String mNama;
    String mTelepon;
    String mEmail;
    String mAlamat;
    String mNoKTP;
    String mScanKTP;
    String mPasFoto;

    EditText txtNama, txtTelepon, txtEmail, txtAlamat, txtNoKTP;
    TextView txtPathScanKTP, txtPathPasFoto;
    Button btnUpdateProfil, btnScanKTP, btnPasFoto;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_edit_account);

        progressDialog = new ProgressDialog(this);
        authdataa = new authdata(this);
        queue = Volley.newRequestQueue(this);

        mIdReseller = authdataa.getKodeUser();

        initWidgetId();
    }

//    private void selectImage() {
//        Intent intent = new Intent();
//        intent.setType("image/*");
//        intent.setAction(intent.ACTION_GET_CONTENT);
//        startActivityForResult(intent, IMG_REQUEST);
//    }

    private void initWidgetId() {
        btnUpdateProfil = findViewById(R.id.btnupdateakun);
        btnScanKTP = findViewById(R.id.btnscanktp);
        btnPasFoto = findViewById(R.id.btnprofil);
        txtPathScanKTP = findViewById(R.id.edtxscanktp);
        txtPathPasFoto = findViewById(R.id.edtxprofil);
        txtNoKTP = findViewById(R.id.edtxnoktp);
        txtNama = findViewById(R.id.edtxtnama);
        txtAlamat = findViewById(R.id.edtxalamat);
        txtTelepon = findViewById(R.id.edtxno);
        txtEmail = findViewById(R.id.edtxtemail);
    }
}
