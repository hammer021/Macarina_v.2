package com.example.macarina_v2;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;

public class ActivityPilihVarian extends AppCompatActivity {
    Button ori, coklat;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_pilih_varian);
        ori = findViewById(R.id.varianOri);
        ori.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent co1 = new Intent(ActivityPilihVarian.this, ActivityCheckout.class);
                startActivity(co1);
            }
        });
        coklat = findViewById(R.id.varianCoklat);
        coklat.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent co2 = new Intent(ActivityPilihVarian.this, ActivityCheckoutCoklat.class);
                startActivity(co2);
            }
        });
    }
}
