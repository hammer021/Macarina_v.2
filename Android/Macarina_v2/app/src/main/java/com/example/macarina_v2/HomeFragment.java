package com.example.macarina_v2;

import androidx.annotation.MainThread;
import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;
import androidx.fragment.app.Fragment;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;

import com.example.macarina_v2.configfile.authdata;
import com.synnapps.carouselview.CarouselView;
import com.synnapps.carouselview.ImageListener;

import java.util.ArrayList;
import java.util.List;

public class HomeFragment extends Fragment {
    CarouselView carouselView;
    int[] sampleImage = {
            R.drawable.person_1,
            R.drawable.person_2
    };

    View view, view2;
    TextView txtlaporan, txtname, txtlokasi;
    authdata authdataa;


    @Nullable
    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        View v = inflater.inflate(R.layout.activity_home_fragment, container, false);
        carouselView = v.findViewById(R.id.Banner);
        carouselView.setPageCount(sampleImage.length);
        view = v.findViewById(R.id.viewLaporan);
        view.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent a = new Intent(getContext(), ReportActivity.class);
                startActivity(a);
            }
        });
        txtlaporan = v.findViewById(R.id.textlaporan);
        txtlaporan.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent b = new Intent(getContext(), ReportActivity.class);
                startActivity(b);
            }
        });
        view2 = v.findViewById(R.id.viewLocation);
        view2.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent map = new Intent(getActivity(), MapsActivity.class);
                startActivity(map);
            }
        });
        txtlokasi = v.findViewById(R.id.textView13);
        txtlokasi.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent map2 = new Intent(getActivity(), MapsActivity.class);
                startActivity(map2);
            }
        });

        authdataa = new authdata(getContext());
        txtname = v.findViewById(R.id.tName);
        txtname.setText(authdataa.getNamaUser());

        ImageListener imageListener = new ImageListener() {
            @Override
            public void setImageForPosition(int position, ImageView imageView) {
                imageView.setImageResource(sampleImage[position]);
            }
        };

        carouselView.setImageListener(imageListener);
    return v;
    }



}
