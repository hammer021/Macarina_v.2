package com.example.macarina_v2;

import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;

import android.app.Activity;
import android.app.ProgressDialog;
import android.content.Intent;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.net.Uri;
import android.os.Bundle;
import android.util.Base64;
import android.util.Log;
import android.view.View;
import android.widget.Button;
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

import org.json.JSONArray;
import org.json.JSONObject;

import java.io.ByteArrayOutputStream;
import java.io.FileNotFoundException;
import java.io.InputStream;
import java.util.HashMap;
import java.util.Map;

public class ActivityDetailPembayaran extends AppCompatActivity {
    TextView kddettrans, tgldettrans, totdettrans, pathuploadpem, kodegawean;
    Button uploadPem, bayarPem, kembali;
    String kd_transaksi_intent;

    ProgressDialog progressDialog;
    RequestQueue requestQueue;
    authdata authdataa;

    private final int IMG_REQUEST = 1;
    boolean statusImage = false;

    Bitmap bitmapBuktiBayar;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_detail_pembayaran);

        kddettrans = findViewById(R.id.kd_transaksi_det);
        tgldettrans = findViewById(R.id.tgltransaksi_det);
        totdettrans = findViewById(R.id.totpeman_det);
        pathuploadpem = findViewById(R.id.textPathUpload);

        uploadPem = findViewById(R.id.btnupload);
        uploadPem.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                selectImage();
            }
        });
        bayarPem = findViewById(R.id.btnbayar_det);
        bayarPem.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                updateBuktiBayar();

                Intent main = new Intent(ActivityDetailPembayaran.this, ActivitySuccess.class);
                startActivity(main);
                finish();
            }
        });
        kembali = findViewById(R.id.backhomepem);

        progressDialog = new ProgressDialog(this);
        requestQueue = Volley.newRequestQueue(this);
        authdataa = new authdata(this);

        Intent intent = getIntent();
        kd_transaksi_intent = intent.getStringExtra("kd_transaksi");

        loadDetail();

        Toast.makeText(this, kd_transaksi_intent, Toast.LENGTH_LONG).show();
    }

    private void loadDetail() {
        Log.e("kode", kd_transaksi_intent);
        progressDialog.show();

        StringRequest bayaran = new StringRequest(Request.Method.POST, ServerApi.URL_DETPEM, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    JSONObject hasilRequest = new JSONObject(response);
                    boolean status = hasilRequest.getBoolean("status");
                    Log.e("res ", hasilRequest.toString());
                    if (status) {
                        JSONArray data = hasilRequest.getJSONArray("data");

                        JSONObject utama = data.getJSONObject(0);
                        String kd_transaksi = utama.getString("kd_transaksi");
                        String tgl_transaksi = utama.getString("tgl_transaksi");
                        String total_pembayaran = utama.getString("total_pembayaran");

                        kddettrans.setText(kd_transaksi);
                        tgldettrans.setText(tgl_transaksi);
                        totdettrans.setText(total_pembayaran);
                    } else {
                        Toast.makeText(ActivityDetailPembayaran.this, "gagal!", Toast.LENGTH_LONG).show();
                    }
                } catch (Exception e) {
                    Toast.makeText(ActivityDetailPembayaran.this, e.toString(), Toast.LENGTH_LONG).show();
                }
                progressDialog.dismiss();
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                progressDialog.dismiss();
                Toast.makeText(ActivityDetailPembayaran.this, error.toString(), Toast.LENGTH_LONG).show();
            }
        }) {
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();
                params.put("kd_transaksi", kd_transaksi_intent.toString().split(" : ")[1]);

                return params;
            }
        };
        requestQueue.add(bayaran);
    }


    private void updateBuktiBayar() {
        StringRequest bayarbosque = new StringRequest(Request.Method.PUT, ServerApi.URL_BAYARBOS, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                progressDialog.dismiss();

                try {
                    JSONObject jsonObject = new JSONObject(response);
                    String message = jsonObject.getString("message");
                    Log.e("res bos ", message.toString());
                    Snackbar.make(findViewById(R.id.activity_detail_pembayaran), message, Snackbar.LENGTH_LONG).show();
                } catch (Exception e) {
                    Toast.makeText(getApplicationContext(), e.toString(), Toast.LENGTH_LONG).show();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                progressDialog.dismiss();
                Toast.makeText(getApplicationContext(), error.toString(), Toast.LENGTH_LONG).show();
            }
        }) {
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();
                params.put("kd_transaksi", kd_transaksi_intent.toString().split(" : ")[1]);
                params.put("bukti_bayar", imageToString(bitmapBuktiBayar));

                return params;
            }
        };

        requestQueue.add(bayarbosque);
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
                String pathGambar = path.getPath();

                bitmapBuktiBayar = BitmapFactory.decodeStream(inputStream);
                pathuploadpem.setText(pathGambar);

                statusImage = true;

            } catch (FileNotFoundException e) {
                Toast.makeText(this, e.toString(), Toast.LENGTH_LONG).show();
            }
        }
    }

    private void selectImage() {
        Intent intent = new Intent();
        intent.setType("image/*");
        intent.setAction(intent.ACTION_GET_CONTENT);
        startActivityForResult(intent, IMG_REQUEST);
    }

    private String imageToString(Bitmap bitmap) {
        ByteArrayOutputStream byteArrayOutputStream = new ByteArrayOutputStream();
        bitmap.compress(Bitmap.CompressFormat.JPEG, 70, byteArrayOutputStream);
        byte[] imageBytes = byteArrayOutputStream.toByteArray();

        String encodedImage = Base64.encodeToString(imageBytes, Base64.DEFAULT);
        return encodedImage;
    }
}
