package com.example.macarina_v2;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;
import androidx.fragment.app.Fragment;

import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;

import com.example.macarina_v2.configfile.authdata;

public class AkunFragment extends Fragment {
    TextView txtnama;
    ImageView profil;
    authdata authdataa;
    @Nullable
    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        View v = inflater.inflate(R.layout.activity_akun_fragment, container, false);
        //        return super.onCreateView(inflater, container, savedInstanceState);
        txtnama = v.findViewById(R.id.txtnama);
        authdataa = new authdata(getContext());
        txtnama.setText(authdataa.getNamaUser());
        profil = v.findViewById(R.id.FotoProfil);
        return v;
    }
}
