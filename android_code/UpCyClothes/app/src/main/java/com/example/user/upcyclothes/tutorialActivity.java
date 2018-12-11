package com.example.user.upcyclothes;

import android.media.Image;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;

public class tutorialActivity extends AppCompatActivity {
    boolean finalChk=false;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_tutorial);

        final ImageView firstIV= (ImageView)findViewById(R.id.firstIV);
        Button btn= (Button)findViewById(R.id.btn);
        btn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if (!finalChk) {
                    firstIV.setImageResource(R.drawable.second);
                    finalChk = true;
                }
                else finish();
            }

        });
    }
}
