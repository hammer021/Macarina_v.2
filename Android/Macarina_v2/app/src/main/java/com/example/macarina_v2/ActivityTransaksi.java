package com.example.macarina_v2;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.Spinner;
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

import org.json.JSONArray;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.Calendar;
import java.util.HashMap;
import java.util.Map;

public class ActivityTransaksi extends AppCompatActivity {
    ArrayList<String> provinsiLisst, kotaList;
    ArrayAdapter provinsiAdapter, kotaAdapter;

    RequestQueue requestQueue;
    authdata authdataa;

    Spinner provinsiSpinner, kotaSpinner;

    String idProvinsi, idKota, idKotaAsal = "160", weightnya;
    Integer GRANDTTL, value, hargaTotal;

    TextView totaaall, idressss;
    TextView costText, tgll, costan, pemantot;

    Button simpantrans;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_transaksi);

        provinsiLisst = new ArrayList<>();
        kotaList = new ArrayList<>();
        authdataa = new authdata(this);

        provinsiLisst.add("pilih provinsi");
        kotaList.add("pilih kota");

        requestQueue = Volley.newRequestQueue(this);

        provinsiSpinner = findViewById(R.id.provinsi);
        kotaSpinner = findViewById(R.id.kota);
        costText = findViewById(R.id.cost);
        totaaall = findViewById(R.id.txtgrandtotal);

        costan = findViewById(R.id.costingan);

        pemantot = findViewById(R.id.totpeman);


        idressss = findViewById(R.id.idress);
        idressss.setText(authdataa.getKodeUser());

        tgll = findViewById(R.id.txttgltransaksi);
        tgll.setText(getCurrentDate());

        simpantrans = findViewById(R.id.btnbayar);
        simpantrans.setEnabled(false);
        simpantrans.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                simpanTransaksi();
            }
        });
        kotaSpinner.setEnabled(false);

        loadProvinsi();
        loadGrand();
        loadWeight();

        provinsiSpinner.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
            @Override
            public void onItemSelected(AdapterView<?> parent, View view, int position, long id) {
                String provinsi = provinsiSpinner.getSelectedItem().toString().trim();
                String[] separated = provinsi.split("-");

                idProvinsi = separated[0];

                kotaSpinner.setEnabled(true);

                if (provinsiSpinner.getSelectedItem().toString().trim().equals("pilih provinsi")) {
                    kotaSpinner.setEnabled(false);
                } else {
                    loadKota();
                }
            }

            @Override
            public void onNothingSelected(AdapterView<?> parent) {
                kotaSpinner.setEnabled(false);
            }
        });

        kotaSpinner.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
            @Override
            public void onItemSelected(AdapterView<?> parent, View view, int position, long id) {
                String kota = kotaSpinner.getSelectedItem().toString().trim();
                String[] separated = kota.split("-");

                idKota = separated[0];

                if (kotaSpinner.getSelectedItem().toString().trim().equals("pilih kota")) {
                    costText.setText("----");
                } else {
                    loadCost();
                    simpantrans.setEnabled(true);
                }
            }

            @Override
            public void onNothingSelected(AdapterView<?> parent) {

            }
        });
    }

    public String getCurrentDate(){
        final Calendar c = Calendar.getInstance();
        int year, month, day;
        year = c.get(Calendar.YEAR);
        month = c.get(Calendar.MONTH);
        day = c.get(Calendar.DATE);
        return day + "-" + (month+1) + "-" + year;
    }

    private void simpanTransaksi()
    {
        final String id_reseller = this.idressss.getText().toString().trim();
        final String transcos = this.costan.getText().toString().trim();
        final String transtotpem = this.pemantot.getText().toString().trim();

        StringRequest simpantrans = new StringRequest(Request.Method.POST, ServerApi.URL_TRANSPEM, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try
                {
                    JSONObject objecttmbh = new JSONObject(response);
                    String status = objecttmbh.getString("status");
                    String error = objecttmbh.getString("error");
                    String message = objecttmbh.getString("message");

                    if (status.equals("200") && error.equals("false")) {
                        Toast.makeText(ActivityTransaksi.this, message, Toast.LENGTH_SHORT).show();
                        new Handler().postDelayed(new Runnable() {
                            @Override
                            public void run() {
                                Intent intent2 = new Intent(ActivityTransaksi.this, MainActivity.class);
                                startActivity(intent2);
                            }
                        }, 1500);

                    } else {
                        Toast.makeText(ActivityTransaksi.this, message, Toast.LENGTH_SHORT).show();
                    }
                } catch (Exception e) {
                    e.printStackTrace();
                    Intent intent3 = new Intent(ActivityTransaksi.this, MainActivity.class);
                    startActivity(intent3);
                    Toast.makeText(getApplicationContext(), "Lanjutkan transaksi anda dengan Upload Bukti Pembayaran.", Toast.LENGTH_LONG).show();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(ActivityTransaksi.this, error.toString(), Toast.LENGTH_SHORT).show();
            }
        }) {
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();
                params.put("id_reseller", id_reseller);
                params.put("cost", transcos);
                params.put("total_pembayaran", transtotpem);
                return params;
            }
        };
        requestQueue.add(simpantrans);
    }

    private void loadProvinsi() {
        StringRequest provinsiReq = new StringRequest(Request.Method.GET, "https://api.rajaongkir.com/starter/province?key=11490ff6fb87615c1708b4ab22b7dd49", new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    JSONObject objectLuar = new JSONObject(response);
                    JSONObject rajaOngkir = objectLuar.getJSONObject("rajaongkir");

                    JSONArray listProvinsi = rajaOngkir.getJSONArray("results");

                    for (int i = 0; i < listProvinsi.length(); i++) {
                        JSONObject itemProvinsi = listProvinsi.getJSONObject(i);

                        provinsiLisst.add(itemProvinsi.getString("province_id") + "-" + itemProvinsi.getString("province"));
                    }

                    provinsiAdapter = new ArrayAdapter(getApplicationContext(), android.R.layout.simple_spinner_item, provinsiLisst);
                    provinsiAdapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);

                    provinsiSpinner.setAdapter(provinsiAdapter);
                } catch (Exception e) {
                    Toast.makeText(getApplicationContext(), e.toString(), Toast.LENGTH_LONG).show();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(getApplicationContext(), error.toString(), Toast.LENGTH_LONG).show();
            }
        });

        requestQueue.add(provinsiReq);
    }

    private void loadKota() {
        StringRequest kotaReq = new StringRequest(Request.Method.GET, "https://api.rajaongkir.com/starter/city?key=11490ff6fb87615c1708b4ab22b7dd49&province=" + idProvinsi, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    JSONObject objekLuar = new JSONObject(response);
                    JSONObject rajaOngkir = objekLuar.getJSONObject("rajaongkir");

                    JSONArray results = rajaOngkir.getJSONArray("results");

                    kotaList = new ArrayList<>();
                    kotaList.add("pilih kota");

                    for (int i = 0; i < results.length(); i++) {
                        JSONObject kota = results.getJSONObject(i);

                        String idKota = kota.getString("city_id");
                        String namaKota = kota.getString("city_name");
                        String postalCode = kota.getString("postal_code");

                        kotaList.add(idKota + "-" + namaKota + " (" + postalCode + ")");
                    }

                    kotaAdapter = new ArrayAdapter(getApplicationContext(), android.R.layout.simple_spinner_item, kotaList);
                    kotaAdapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);

                    kotaSpinner.setAdapter(kotaAdapter);
                } catch (Exception e) {
                    Toast.makeText(getApplicationContext(), e.toString(), Toast.LENGTH_LONG).show();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(getApplicationContext(), error.toString(), Toast.LENGTH_LONG).show();
            }
        });

        requestQueue.add(kotaReq);
    }

    private void loadCost() {
        StringRequest costReq = new StringRequest(Request.Method.POST, "https://api.rajaongkir.com/starter/cost", new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    JSONObject objekLuar = new JSONObject(response);
                    JSONObject rajaOngkir = objekLuar.getJSONObject("rajaongkir");
                    JSONArray results = rajaOngkir.getJSONArray("results");

                    JSONObject resultsObject = results.getJSONObject(0);
                    JSONArray costs = resultsObject.getJSONArray("costs");
                    JSONObject reguler = costs.getJSONObject(1);

                    JSONArray cost = reguler.getJSONArray("cost");
                    JSONObject costObject = cost.getJSONObject(0);

                    value = costObject.getInt("value");
                    String etd = costObject.getString("etd");

                    hargaTotal = value + GRANDTTL;

                    costText.setText(String.valueOf(hargaTotal));

                    costan.setText(String.valueOf(value));
                    pemantot.setText(String.valueOf(hargaTotal));

                } catch (Exception e) {
                    Toast.makeText(getApplicationContext(), e.toString(), Toast.LENGTH_LONG).show();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(getApplicationContext(), error.toString(), Toast.LENGTH_LONG).show();
            }
        }) {
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();
                params.put("key", "11490ff6fb87615c1708b4ab22b7dd49");
                params.put("origin", idKotaAsal);
                params.put("destination", idKota);
                params.put("weight", weightnya);
                params.put("courier", "jne");
                return params;
            }
        };

        requestQueue.add(costReq);
    }

    private void loadWeight()
    {
        StringRequest weightdata = new StringRequest(Request.Method.GET, ServerApi.URL_BERAT + authdataa.getKodeUser(), new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    JSONObject objectluar = new JSONObject(response);
                    JSONObject data = objectluar.getJSONObject("data");
                    weightnya = data.getString("berat");
                } catch (Exception e) {
                    Toast.makeText(ActivityTransaksi.this, e.toString(), Toast.LENGTH_LONG).show();
                }

            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(ActivityTransaksi.this, error.toString(), Toast.LENGTH_LONG).show();
            }
        });
        requestQueue.add(weightdata);
    }

    private void loadGrand()
    {
        StringRequest granddata = new StringRequest(Request.Method.GET, ServerApi.URL_GRAND + authdataa.getKodeUser(), new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    JSONObject objectluar = new JSONObject(response);
                    JSONObject data = objectluar.getJSONObject("data");
                    GRANDTTL = data.getInt("total");
                    totaaall.setText("Total : " + GRANDTTL);
                } catch (Exception e) {
                    Toast.makeText(ActivityTransaksi.this, e.toString(), Toast.LENGTH_LONG).show();
                }

            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(ActivityTransaksi.this, error.toString(), Toast.LENGTH_LONG).show();
            }
        });
        requestQueue.add(granddata);
    }

}
