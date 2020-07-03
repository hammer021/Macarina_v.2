package com.example.macarina_v2;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

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

import java.util.ArrayList;
import java.util.List;

public class ActivityPembayaran extends AppCompatActivity {
    RecyclerView recyclerViewPem;
    List<ModalPembayaran> item;
    AdapterPembayaran adapterPembayaran;
    RequestQueue requestQueue;
    authdata authdataa;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_pembayaran);

        recyclerViewPem = findViewById(R.id.recyclerPem);
        requestQueue = Volley.newRequestQueue(this);
        authdataa = new authdata(this);

        loadCart();
    }

    private void loadCart()
    {
        StringRequest senddata = new StringRequest(Request.Method.GET, ServerApi.URL_BELUMBAYAR + authdataa.getKodeUser(), new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try{
                    JSONObject objectLuar = new JSONObject(response);
                    JSONArray data = objectLuar.getJSONArray("data");

                    item = new ArrayList<>();
                    for (int i = 0; i < data.length(); i++)
                    {
                        ModalPembayaran playerModel = new ModalPembayaran();
                        JSONObject datae = data.getJSONObject(i);
                        playerModel.setKd_transaksiPem(datae.getString( "kd_transaksi"));
                        playerModel.setTgl_transaksiPem(datae.getString("tgl_transaksi"));
                        playerModel.setTotal_pembayaranPem(datae.getString("total_pembayaran"));
                        playerModel.setStatus_bayarPem(datae.getString("status_bayar"));

                        item.add(playerModel);
                    }
                    setupListView();
                } catch (Exception e) {
                    Toast.makeText(ActivityPembayaran.this, e.toString(), Toast.LENGTH_LONG).show();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(ActivityPembayaran.this, error.toString(), Toast.LENGTH_LONG).show();
            }
        });
        requestQueue.add(senddata);
    }

    private void setupListView() {
        adapterPembayaran = new AdapterPembayaran(this, item);
        RecyclerView.LayoutManager layoutManager = new LinearLayoutManager(getApplicationContext());
        recyclerViewPem.setLayoutManager(layoutManager);
        recyclerViewPem.setAdapter(adapterPembayaran);

        adapterPembayaran.setListener(new AdapterPembayaran.OnHistoryClickListener() {
            @Override
            public void onClick(int position) {
                ModalPembayaran modalPembayaran = item.get(position);
                Toast.makeText(ActivityPembayaran.this, modalPembayaran.getKd_transaksiPem(), Toast.LENGTH_LONG).show();

                Intent detail = new Intent(ActivityPembayaran.this, ActivityDetailPembayaran.class);
                detail.putExtra("kd_transaksi", modalPembayaran.getKd_transaksiPem());
                startActivity(detail);
            }
        });
    }
}
