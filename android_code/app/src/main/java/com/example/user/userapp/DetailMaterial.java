package com.example.user.userapp;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.TextView;

import com.bumptech.glide.Glide;

public class DetailMaterial extends AppCompatActivity {

    String name;
    String remainAmount;
    String url;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_detail_material);
        Intent intent = getIntent();
        name=intent.getStringExtra("item name");
        remainAmount=intent.getStringExtra("item remain amount");
        url=intent.getStringExtra("item url");

        ImageView thumb=(ImageView)findViewById(R.id.thumbs);
        Glide.with(this).load(url).into(thumb);
        //이미지 세팅
        TextView itemName= (TextView)findViewById(R.id.nameTV);
        itemName.setText(name);
        TextView remainAmountTV= (TextView)findViewById(R.id.remainAmountTV);
        remainAmountTV.setText(remainAmount+"KG");
        EditText itemAmount= (EditText)findViewById(R.id.amountET);
        Button orderBtn = (Button)findViewById(R.id.orderBtn);


        orderBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                /*Go to Next Activity*/

                Intent intent = new Intent(DetailMaterial.this, LoginActivity.class);
                //intent.putExtra("amount",name );
                //intent.putExtra("userID",userID);
                startActivity(intent);
                finish();

            }
        });

    }
}
