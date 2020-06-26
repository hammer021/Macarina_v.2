package com.example.macarina_v2;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import android.os.Bundle;
import android.util.Log;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.macarina_v2.configfile.ServerApi;
import com.example.macarina_v2.configfile.authdata;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

import static java.security.AccessController.getContext;

public class ReportActivity extends AppCompatActivity {
    RecyclerView recyclerView;
    List<ModalReportActivity> mItems;
    String data;
    AdapterReportActivity mAdapter;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_report);
        recyclerView = findViewById(R.id.recycler);
        data = authdata.getInstance(getApplicationContext()).getAksesData();
        Log.e("data","response");

        loaddata();
    }

    public void loaddata()
    {
        StringRequest stringRequest  = new StringRequest(Request.Method.GET, ServerApi.IPServer+"api/riwayat?NIM=" , new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                Log.d("strrrrr", ">>" + response);
                try {
                    JSONObject obj  = new JSONObject(response);

                    mItems = new ArrayList<>();
                    JSONArray data = obj.getJSONArray("data");
                    for (int i = 0; i < data.length(); i++)
                    {
                        ModalReportActivity playerModel = new ModalReportActivity();
                        JSONObject dataobj = data.getJSONObject(i);
                        playerModel.setTanggal(dataobj.getString("tanggal"));
                        playerModel.setKdtransaksi(dataobj.getString("kdtransaksi"));
                        playerModel.setGrandtotal(dataobj.getString("grandtotal"));

                        mItems.add(playerModel);
                    }
                    //setupListView();

                }
                catch (JSONException e)
                {
                    e.printStackTrace();
                }
            }
        },
                new Response.ErrorListener()
                {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Log.d("volley", "errornya : " + error.getMessage());
                    }
                });

        RequestQueue requestQueue = Volley.newRequestQueue(getApplicationContext());
        requestQueue.add(stringRequest);
    }

//    private void setupListView()
//    {
//        mAdapter = new AdapterReportActivity(getContext(), mItems);
//        RecyclerView.LayoutManager layoutManager = new LinearLayoutManager(getActivity().getApplicationContext());
//        tempatdata.setLayoutManager(layoutManager);
//        tempatdata.setAdapter(mAdapter);
//
//    }
}
