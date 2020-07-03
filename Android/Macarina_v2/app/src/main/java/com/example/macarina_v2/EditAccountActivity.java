package com.example.macarina_v2;

import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;

import android.app.ProgressDialog;
import android.content.Intent;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.net.Uri;
import android.os.Bundle;
import android.util.Base64;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

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
import com.android.volley.toolbox.Volley;
import com.example.macarina_v2.configfile.ServerApi;
import com.example.macarina_v2.configfile.authdata;
import com.google.android.material.snackbar.Snackbar;
import com.google.android.material.textfield.TextInputLayout;

import org.json.JSONArray;
import org.json.JSONObject;

import java.io.ByteArrayOutputStream;
import java.io.FileNotFoundException;
import java.io.InputStream;
import java.util.HashMap;
import java.util.Map;

public class EditAccountActivity extends AppCompatActivity {
    ProgressDialog progressDialog;
    authdata authdataa;
    RequestQueue queue;
    ArrayAdapter<String> adapter;

    private final int IMG_REQUEST = 1;
    boolean statusImage = false;

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
    Bitmap bitmapProfil, BitmapProfil2;

    String selected;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_edit_account);

        progressDialog = new ProgressDialog(this);
        authdataa = new authdata(this);
        queue = Volley.newRequestQueue(this);

        mIdReseller = authdataa.getKodeUser();

        initWidgetId();
        btnUpdateProfil.setEnabled(false);
        loadProfil();

        btnScanKTP.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                selected = "KTP";
                selectImage();
            }
        });
        btnPasFoto.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                selected = "PAS_FOTO";
                selectImage();
            }
        });

        btnUpdateProfil.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if (validateTextInput(txtNoKTP, "Nik harus diisi!") &
                        validateTextInput(txtNama, "Nama harus diisi!") &
                        validateTextInput(txtAlamat, "Alamat harus diisi!") &
                        validateTextInput(txtTelepon, "Telepon harus diisi!") &
                        validateTextInput(txtEmail, "Email harus diisi!")) {

                    updateProfil();

                    Intent main = new Intent(EditAccountActivity.this, MainActivity.class);
                    startActivity(main);
                    finish();

                } else {
                    Snackbar.make(findViewById(R.id.activity_edit_account), "Data diri belum terpenuhi", Snackbar.LENGTH_SHORT).show();
                }
            }
        });
    }

    private void selectImage() {
        Intent intent = new Intent();
        intent.setType("image/*");
        intent.setAction(intent.ACTION_GET_CONTENT);
        startActivityForResult(intent, IMG_REQUEST);
//        startActivityForResult(intent, IMG_REQUEST2);
    }

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

    private boolean validateTextInput(EditText editText, String errorMessage) {
        String input = editText.getText().toString().trim();

        if (input.isEmpty()) {
            editText.setError(errorMessage);
            return false;
        } else {
            editText.setError(null);
            return true;
        }
    }

    //    konversi gambar menjadi string
    private String imageToString(Bitmap bitmap) {
        ByteArrayOutputStream byteArrayOutputStream = new ByteArrayOutputStream();
        bitmap.compress(Bitmap.CompressFormat.JPEG, 70, byteArrayOutputStream);
        byte[] imageBytes = byteArrayOutputStream.toByteArray();

        String encodedImage = Base64.encodeToString(imageBytes, Base64.DEFAULT);
        return encodedImage;
    }

    private void loadProfil() {
        progressDialog.setMessage("Sedang Memperbarui Data...");
        progressDialog.setCancelable(false);
        progressDialog.show();

        String url = ServerApi.URL_USER + mIdReseller;

        StringRequest stringRequest = new StringRequest(Request.Method.GET, url, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                progressDialog.dismiss();
                try {
                    JSONObject jsonObject = new JSONObject(response);
                    String status = jsonObject.getString("status");

                    if (status.equals("false")) {
                        String message = jsonObject.getString("message");
                        Snackbar.make(findViewById(R.id.activity_edit_account), message, Snackbar.LENGTH_LONG).show();
                    } else {
                        JSONArray data = jsonObject.getJSONArray("data");
                        JSONObject dataUser = data.getJSONObject(0);

                        mNama = dataUser.getString("nama_reseller");
                        mAlamat = dataUser.getString("alamat");
                        mTelepon = dataUser.getString("no_tlp");
                        mScanKTP = dataUser.getString("scan_ktp");
                        mNoKTP = dataUser.getString("no_ktp");
                        mEmail = dataUser.getString("email");
                        mPasFoto = dataUser.getString("pas_foto");

                        txtNama.setText(mNama);
                        txtAlamat.setText(mAlamat);
                        txtTelepon.setText(mTelepon);
                        txtNoKTP.setText(mNoKTP);
                        txtEmail.setText(mEmail);

                        btnUpdateProfil.setEnabled(true);
                    }
                } catch (Exception e) {
                    Snackbar.make(findViewById(R.id.activity_edit_account), e.toString(), Snackbar.LENGTH_LONG).show();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                progressDialog.dismiss();
                String message = "Terjadi error. Coba beberapa saat lagi.";

                if (error instanceof NetworkError) {
                    message = "Tidak dapat terhubung ke internet. Harap periksa koneksi anda.";
                } else if (error instanceof AuthFailureError) {
                    message = "Gagal login. Harap periksa email dan password anda.";
                } else if (error instanceof ClientError) {
                    message = "Gagal login. Harap periksa email dan password anda.";
                } else if (error instanceof NoConnectionError) {
                    message = "Tidak ada koneksi internet. Harap periksa koneksi anda.";
                } else if (error instanceof TimeoutError) {
                    message = "Connection Time Out. Harap periksa koneksi anda.";
                }

                Snackbar.make(findViewById(R.id.activity_edit_account), message, Snackbar.LENGTH_LONG).show();
            }
        });
        queue.add(stringRequest);
    }

    private void updateProfil() {
        progressDialog.setMessage("Sedang Memperbarui Data...");
        progressDialog.setCancelable(false);
        progressDialog.show();

        String url = ServerApi.URL_PUT_USER;

        StringRequest updateRequest = new StringRequest(Request.Method.PUT, url, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                progressDialog.dismiss();

                try {
                    JSONObject jsonObject = new JSONObject(response);
                    String message = jsonObject.getString("message");

                    Snackbar.make(findViewById(R.id.activity_edit_account), message, Snackbar.LENGTH_LONG).show();
                } catch (Exception e) {
                    Toast.makeText(getApplicationContext(), e.toString(), Toast.LENGTH_LONG).show();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                progressDialog.dismiss();
                String message = "Terjadi error. Coba beberapa saat lagi.";

                if (error instanceof NetworkError) {
                    message = "Tidak dapat terhubung ke internet. Harap periksa koneksi anda.";
                } else if (error instanceof AuthFailureError) {
                    message = "Gagal login. Harap periksa email dan password anda.";
                } else if (error instanceof ClientError) {
                    message = "Gagal login. Harap periksa email dan password anda.";
                } else if (error instanceof NoConnectionError) {
                    message = "Tidak ada koneksi internet. Harap periksa koneksi anda.";
                } else if (error instanceof TimeoutError) {
                    message = "Connection Time Out. Harap periksa koneksi anda.";
                }

                Snackbar.make(findViewById(R.id.activity_edit_account), message, Snackbar.LENGTH_LONG).show();
            }
        }) {
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();

                params.put("id_reseller", mIdReseller);
                params.put("nama_reseller", txtNama.getText().toString().trim());
                params.put("alamat", txtAlamat.getText().toString().trim());
                params.put("no_tlp", txtTelepon.getText().toString().trim());
                params.put("scan_ktp", imageToString(bitmapProfil));
                params.put("no_ktp", txtNoKTP.getText().toString().trim());
                params.put("email", txtEmail.getText().toString().trim());
                params.put("pas_foto", imageToString(BitmapProfil2));

                return params;
            }
        };

        queue.add(updateRequest);
    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, @Nullable Intent data) {
        super.onActivityResult(requestCode, resultCode, data);
        if (requestCode == IMG_REQUEST && resultCode == RESULT_OK && data != null) {
//            mengambil alamat file gambar
            Uri path = data.getData();
//            Uri path2 = data.getData();

            try {
                InputStream inputStream = getContentResolver().openInputStream(path);
//                InputStream inputStream2 = getContentResolver().openInputStream(path2);
                String pathGambar = path.getPath();
//                String pathGambar2 = path2.getPath();

                if(selected.equals("KTP")){
                    bitmapProfil = BitmapFactory.decodeStream(inputStream);
                    txtPathScanKTP.setText(pathGambar);
                } else {
                    BitmapProfil2 = BitmapFactory.decodeStream(inputStream);
                    txtPathPasFoto.setText(pathGambar);
                }
                statusImage = true;

            } catch (FileNotFoundException e) {
                Toast.makeText(this, e.toString(), Toast.LENGTH_LONG).show();
            }
        }
    }
}
