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
import android.widget.TextView;

import com.example.macarina_v2.configfile.authdata;

import java.util.ArrayList;
import java.util.List;

public class HomeFragment extends Fragment {
    TextView tname, tAkun;
    View vlaporan;
    ProgressDialog pd;
    View vAkun;
    @Nullable
    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        View v = inflater.inflate(R.layout.activity_home_fragment, container, false);

    return v;
    }



}
