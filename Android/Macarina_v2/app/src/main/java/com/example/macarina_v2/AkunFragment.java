package com.example.macarina_v2;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;
import androidx.fragment.app.Fragment;

import android.content.Intent;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.macarina_v2.configfile.ServerApi;
import com.example.macarina_v2.configfile.authdata;
import com.squareup.picasso.Picasso;

import de.hdodenhof.circleimageview.CircleImageView;

public class AkunFragment extends Fragment {
    private static final String pas_foto = "pas_foto";
    private String mFotoProfil;

    TextView txtnama, txtedit, txtlogout;
    ImageView imgEdit, imgLogout;
    authdata authdataa;
    CircleImageView profile;


    @Nullable
    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        View v = inflater.inflate(R.layout.activity_akun_fragment, container, false);
        //        return super.onCreateView(inflater, container, savedInstanceState);
        authdataa = new authdata(getContext());


        txtnama = v.findViewById(R.id.txtnama);
        txtnama.setText(authdataa.getNamaUser());

        mFotoProfil = ServerApi.URL_PASFOTO + authdataa.getFoto_user();

        profile = v.findViewById(R.id.FotoProfil);
        Picasso.get().load(mFotoProfil).into(profile);

        imgEdit = v.findViewById(R.id.imageView);
        imgEdit.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent edit = new Intent(getActivity(), EditAccountActivity.class);
                startActivity(edit);
            }
        });

        txtedit = v.findViewById(R.id.editAkun);
        txtedit.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent edit = new Intent(getActivity(), EditAccountActivity.class);
                startActivity(edit);
            }
        });

        imgLogout = v.findViewById(R.id.imageView2);
        imgLogout.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                authdata authdatanya = new authdata(getActivity());
                authdatanya.logout();
            }
        });
        txtlogout = v.findViewById(R.id.logout);
        txtlogout.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                authdata authdatanya = new authdata(getActivity());
                authdatanya.logout();
            }
        });
        return v;
    }

//    private void loadAkun(){
//        StringRequest akunRequest = new StringRequest(Request.Method.GET, ServerApi.URL_USER + authdataa.getKodeUser(), new Response.Listener<String>() {
//            @Override
//            public void onResponse(String response) {
//                try
//            }
//        }, new Response.ErrorListener() {
//            @Override
//            public void onErrorResponse(VolleyError error) {
//
//            }
//        });
//
//        requestQueue.add(akunRequest);
//    }
//    public static AkunFragment newInstance(String foto) {
//        AkunFragment fragment = new AkunFragment();
//        Bundle args = new Bundle();
//        args.putString(pas_foto, foto);
//        fragment.setArguments(args);
//        return fragment;
//    }
//
//    @Override
//    public void onCreate(Bundle savedInstanceState) {
//        super.onCreate(savedInstanceState);
//        mFotoProfil = "http://192.168.100.88/Macarina_v.2/Web/Uploads/reseller/pas_foto/" + getArguments().getString(pas_foto);
//    }
}
