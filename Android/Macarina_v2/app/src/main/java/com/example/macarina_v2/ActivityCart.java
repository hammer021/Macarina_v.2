package com.example.macarina_v2;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import android.app.DownloadManager;
import android.content.Intent;
import android.os.Bundle;
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
import com.example.macarina_v2.configfile.ServerApi;
import com.example.macarina_v2.configfile.authdata;

import org.json.JSONArray;
import org.json.JSONObject;

import java.security.spec.ECField;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.List;

public class ActivityCart extends AppCompatActivity {
    RecyclerView recyclerViewCart;
    List<ModalCart> item;
    String GRANDTTL;
    AdapterCart adapterCart;
    RequestQueue queue;
    Button tr;
    TextView grandd;
    authdata authdataa;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_cart);

        recyclerViewCart = findViewById(R.id.recyclerCart);
        tr = findViewById(R.id.btntransaksi);
        tr.setEnabled(false);
        grandd = findViewById(R.id.teksgrand);

        authdataa = new authdata(this);
        queue = Volley.newRequestQueue(this);

        loadCart();
        loadGrand();
    }

    private void loadCart()
    {
        StringRequest senddata = new StringRequest(Request.Method.GET, ServerApi.URL_CART + authdataa.getKodeUser(), new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try{
                    JSONObject objectLuar = new JSONObject(response);
                    JSONArray data = objectLuar.getJSONArray("data");

                    item = new ArrayList<>();
                    for (int i = 0; i < data.length(); i++)
                    {
                        ModalCart playerModel = new ModalCart();
                        JSONObject datae = data.getJSONObject(i);
                        playerModel.setQty_det(datae.getString( "qty_det"));
                        playerModel.setSubtotal(datae.getString("subtotal"));
                        playerModel.setNama_barang(datae.getString("nama_barang"));
                        playerModel.setHarga(datae.getString("harga"));

                        item.add(playerModel);

                        tr.setEnabled(true);
                        tr.setOnClickListener(new View.OnClickListener() {
                            @Override
                            public void onClick(View v) {
                                Intent pem = new Intent(getApplicationContext(), ActivityTransaksi.class);
                                startActivity(pem);
                            }
                        });
                    }
                    setupListView();
                } catch (Exception e) {
                    Toast.makeText(ActivityCart.this, e.toString(), Toast.LENGTH_LONG).show();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(ActivityCart.this, error.toString(), Toast.LENGTH_LONG).show();
            }
        });
            queue.add(senddata);
    }

    private void setupListView() {
        adapterCart = new AdapterCart(this, item);
        RecyclerView.LayoutManager layoutManager = new LinearLayoutManager(getApplicationContext());
        recyclerViewCart.setLayoutManager(layoutManager);
        recyclerViewCart.setAdapter(adapterCart);
    }

    private void loadGrand()
    {
        StringRequest granddata = new StringRequest(Request.Method.GET, ServerApi.URL_GRAND + authdataa.getKodeUser(), new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    JSONObject objectluar = new JSONObject(response);
                    JSONObject data = objectluar.getJSONObject("data");
                    GRANDTTL = data.getString("total");
                    if (GRANDTTL == "null"){
                        Toast.makeText(ActivityCart.this, "Cart Anda kosong !" , Toast.LENGTH_LONG).show();
                    } else {
                        grandd.setText("Total : " + GRANDTTL);
                    }
                } catch (Exception e) {
                    Toast.makeText(ActivityCart.this, e.toString(), Toast.LENGTH_LONG).show();
                }

            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(ActivityCart.this, error.toString(), Toast.LENGTH_LONG).show();
            }
        });
        queue.add(granddata);
    }
}
