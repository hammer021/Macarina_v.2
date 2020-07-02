package com.example.macarina_v2;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
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
import com.google.android.material.snackbar.Snackbar;
import com.squareup.picasso.Picasso;

import org.json.JSONArray;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

public class ActivityCheckoutBox extends AppCompatActivity {
    ImageView gambarbarange;
    RequestQueue requestQueue;
    authdata authdataa;

    TextView nmbrg, hrg, stk, dskrpsi;
    EditText qty;
    Button btnkembali, btnsave;

    String mNamaBarang;
    String mHarga;
    String mStok;
    String mDeskripsi;
    String mGambar;
    String mPathGambar;
    String mKodeBarang;
    String mIdReseller;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_checkout_box);

        authdataa = new authdata(this);
        requestQueue = Volley.newRequestQueue(this);

        mIdReseller = authdataa.getKodeUser();

        gambarbarange = findViewById(R.id.imgGambarbrg2);
        nmbrg = findViewById(R.id.textbarang2);
        hrg = findViewById(R.id.textharga2);
        stk = findViewById(R.id.textstok2);

        btnsave = findViewById(R.id.addcart2);

        btnkembali = findViewById(R.id.backhome);
        btnkembali.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent tosoon = new Intent(ActivityCheckoutBox.this, MainActivity.class);
                startActivity(tosoon);
                finish();
            }
        });

        dskrpsi = findViewById(R.id.textdeskripsinya2);
        qty = findViewById(R.id.qtytrans2);
        btnsave.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                addcart();
            }
        });


        Picasso.get().load(mPathGambar).into(gambarbarange);

        loadBarang();
    }

    private void loadBarang()
    {
        StringRequest brgload = new StringRequest(Request.Method.GET, ServerApi.URL_BRGBOX, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    JSONObject dataluar = new JSONObject(response);
                    String status = dataluar.getString("status");

                    if (status.equals("false")) {
                        String message = dataluar.getString("message");
                        Snackbar.make(findViewById(R.id.activity_edit_account), message, Snackbar.LENGTH_LONG).show();
                    } else {
                        JSONArray data = dataluar.getJSONArray("data");
                        JSONObject dataUser = data.getJSONObject(0);

                        mKodeBarang = dataUser.getString("kd_barang");
                        mNamaBarang = dataUser.getString("nama_barang");
                        mHarga = dataUser.getString("harga");
                        mStok = dataUser.getString("stok");
                        mDeskripsi = dataUser.getString("deskripsi");
                        mGambar = dataUser.getString("gambar_brg");

                        nmbrg.setText(mNamaBarang);
                        hrg.setText("Harga : " + mHarga);
                        stk.setText("Stok : " + mStok);
                        dskrpsi.setText(mDeskripsi);
                        mPathGambar = ServerApi.URL_GAMBARBRG + mGambar;
                    }
                } catch (Exception e) {
                    Toast.makeText(ActivityCheckoutBox.this, e.toString(), Toast.LENGTH_SHORT).show();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(ActivityCheckoutBox.this, error.toString(), Toast.LENGTH_SHORT).show();
            }
        });
        requestQueue.add(brgload);
    }

    private void addcart()
    {
        final String quantityy = this.qty.getText().toString().trim();

        StringRequest cartadd = new StringRequest(Request.Method.POST, ServerApi.URL_ADDCART + mKodeBarang, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    JSONObject objecttmbh = new JSONObject(response);
                    String status = objecttmbh.getString("status");
                    String error = objecttmbh.getString("error");
                    String message = objecttmbh.getString("message");

                    if (status.equals("200") && error.equals("false")) {
                        Toast.makeText(ActivityCheckoutBox.this, message, Toast.LENGTH_SHORT).show();
                        new Handler().postDelayed(new Runnable() {
                            @Override
                            public void run() {

                                Intent intent2 = new Intent(ActivityCheckoutBox.this, MainActivity.class);
                                startActivity(intent2);
                            }
                        }, 1500);

                    } else {
                        Toast.makeText(ActivityCheckoutBox.this, message, Toast.LENGTH_SHORT).show();
                    }
                } catch (Exception e) {
                    e.printStackTrace();
                    Intent intent3 = new Intent(ActivityCheckoutBox.this, MainActivity.class);
                    startActivity(intent3);
                    Toast.makeText(getApplicationContext(), "Berhasil menambahkan barang di Keranjang.", Toast.LENGTH_LONG).show();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(ActivityCheckoutBox.this, error.toString(), Toast.LENGTH_SHORT).show();
            }
        }){
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();
                params.put("kd_barang", mKodeBarang);
                params.put("qty_det", quantityy);
                params.put("id_reseller", mIdReseller);
                return params;
            }
        };
        requestQueue.add(cartadd);
    }
}
