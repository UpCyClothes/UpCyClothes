package com.example.user.upcyclothes;

import android.content.DialogInterface;
import android.content.Intent;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.RadioButton;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.text.SimpleDateFormat;
import java.util.Date;

public class NextOrderActivity extends AppCompatActivity {
    private String productID;
    private String productName;
    private String productCount;
    private int productTotPrice;
    private String cartIdList;
    private String userName;
    private String userPhn;
    private String address1;
    private String address2;
    private String zipcode;

    private TextView buyerTV;
    private TextView buyerPhn;
    private EditText receiverET;
    private TextView zipcodeTV;
    private TextView addrTV1;
    private EditText addrET2;
    private EditText receiverPhnET;
    private EditText requireET;
    private TextView itemNameTV;
    private TextView cntTV;
    private TextView totPriceTV;
    private ImageView chkAddrBtn;
    private String user_ID;
    private boolean type;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_next_order);
        Intent intent = getIntent();
        type=intent.getBooleanExtra("type",false);
        productID=intent.getStringExtra("productID");
        productName=intent.getStringExtra("productName");
        productCount=intent.getStringExtra("productCount");
        productTotPrice=intent.getIntExtra("productTotPrice",0);
        cartIdList=intent.getStringExtra("cartIdList");
        //서버랑 통신해서 사용자 실명, 연락처, 배송지 받아와야함.
        user_ID=MainActivity.userID;
        LetsConnect letsConnect = new LetsConnect();
        letsConnect.conn();

        buyerTV=(TextView)findViewById(R.id.buyerTV);
        buyerPhn=(TextView)findViewById(R.id.buyerPhn);
        receiverET=(EditText)findViewById(R.id.receiverET);
        zipcodeTV=(TextView)findViewById(R.id.zipcode);
        addrTV1=(TextView)findViewById(R.id.addrET1);
        addrET2=(EditText) findViewById(R.id.addrET2);
        receiverPhnET=(EditText)findViewById(R.id.receiverPhnET);
        requireET=(EditText)findViewById(R.id.requireET);
        itemNameTV=(TextView)findViewById(R.id.itemNameTV);
        cntTV=(TextView)findViewById(R.id.cntTV);
        totPriceTV=(TextView)findViewById(R.id.totPriceTV);
        chkAddrBtn= (ImageView) findViewById(R.id.chkAddrBtn);
        //우편번호 버튼 눌렸을 때
        chkAddrBtn.setOnClickListener(new View.OnClickListener(){
            @Override
            public void onClick(View view) {
                Intent intent =  new Intent( NextOrderActivity.this, DaumWebViewActivity.class);
                startActivityForResult(intent,3000);

            }
        });
        //일단 로그인정보로 채우기.
        buyerTV.setText(userName);
        buyerPhn.setText(userPhn);
        receiverET.setText(userName);
        zipcodeTV.setText(zipcode);
        addrTV1.setText(address1);
        addrET2.setText(address2);
        receiverPhnET.setText(userPhn);
        itemNameTV.setText(productName);
        cntTV.setText(productCount);
        totPriceTV.setText(productTotPrice+"");
        //툴바의 버튼
        // final ImageView alarmBtn= (ImageView) findViewById(R.id.alarmBtn);
        final ImageView cartBtn= (ImageView) findViewById(R.id.cartBtn);
        final ImageView personBtn= (ImageView) findViewById(R.id.personBtn);
        //새로운 문의가 있을 경우에 보여지고 없으면 안보여진다.

        //툴바 버튼리스너
        personBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

                    //마이페이지 고고
                    Intent intent = new Intent(NextOrderActivity.this, MypageActivity.class);
                    //intent.putExtra("sauce name",name );
                    //intent.putExtra("userID",userID);
                    startActivity(intent);
            }
        });
        cartBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

                    Intent intent = new Intent(NextOrderActivity.this, MycartActivity.class);
                    startActivity(intent);

            }
        });

        //주문하기 버튼이 눌릴 경우

        Button registerButton = (Button) findViewById(R.id.signupBtn);
        registerButton.setOnClickListener(new View.OnClickListener() {
            AlertDialog dialog;
            @Override
            public void onClick(View view){
               //사용자가 바꿀 수 있는 값 :receiverET, zipcodeTV, addrTV1, addrET2, receiverPhnET
                String receiverName=receiverET.getText().toString();
                String newZipcode=zipcodeTV.getText().toString();
                String newAddr1=addrTV1.getText().toString();
                String newAddr2=addrET2.getText().toString();
                String require=requireET.getText().toString();

                String receiverPhn=receiverPhnET.getText().toString();

            // 사용자로부터 넘어온 값 포맷 확인

                if(isCellphone(receiverPhn)){
                    //제대로 된 핸드폰 전화

                }
                else {
                    AlertDialog.Builder builder = new AlertDialog.Builder(NextOrderActivity.this);
                    dialog = builder.setMessage("phone 번호가 형식에 맞지 않습니다.")
                            .setNegativeButton("OK", null)
                            .create();
                    dialog.show();
                    return;
                }

                if(receiverName.equals("")||newZipcode.equals("")||newAddr1.equals("")||newAddr2.equals("")||receiverPhn.equals("")){
                    AlertDialog.Builder builder = new AlertDialog.Builder(NextOrderActivity.this);
                    dialog = builder.setMessage("받는 사람 이름, 주소, 받는사람 연락처는 필수 입력 항목입니다.")
                            .setNegativeButton("OK", null)
                            .create();
                    dialog.show();
                    return;
                }
                //서버에 정보 보내기
                Response.Listener<String> responseListener = new Response.Listener<String>() {

                    @Override
                    public void onResponse(String response) {
                        try
                        {
                            Log.v("response",response);
                            JSONObject jsonResponse = new JSONObject(response);
                            boolean success = jsonResponse.getBoolean("success");
                            if (success) {
                                AlertDialog.Builder builder = new AlertDialog.Builder(NextOrderActivity.this);
                                dialog = builder.setMessage("주문해주셔서 감사합니다! 주문처리 과정은 마이페이지 주문내역조회에서 확인해주세요.").setPositiveButton("OK", new DialogInterface.OnClickListener() {
                                    @Override
                                    public void onClick(DialogInterface dialogInterface, int i) {
                                        Intent intent1 = new Intent(NextOrderActivity.this,MainActivity.class);
                                        startActivity(intent1);
                                        finish();
                                    }
                                }).create();
                                dialog.show();

                            }
                            else{
                                AlertDialog.Builder builder = new AlertDialog.Builder(NextOrderActivity.this);
                                dialog = builder.setMessage("Failed - Try One more!")
                                        .setNegativeButton("OK", null)
                                        .create();
                                dialog.show();
                            }
                        }
                        catch (Exception e){
                            e.printStackTrace();
                        }
                    }
                };
                RegisterRequest registerRequest = new RegisterRequest(productID, user_ID, receiverName, newAddr1, newAddr2, newZipcode, require, receiverPhn,
                        productCount, getCurrentDateStamp(), productTotPrice+"","1",type,"","",cartIdList,responseListener);
                RequestQueue queue = Volley.newRequestQueue(NextOrderActivity.this);
                queue.add(registerRequest);
            }
        });
    }


    public String getCurrentDateStamp() {
        Log.v("현재 날짜",new SimpleDateFormat("yyyy-MM-dd").format(new Date()));
        return new SimpleDateFormat("yyyy-MM-dd").format(new Date());
    }
    private class LetsConnect {


        protected void conn() {
            URLConnector task = new URLConnector("https://upcyclothes.duckdns.org", "/android/orderInfo.php", "user_ID=" + user_ID, false);

            Log.v("task", task.toString());
            task.start();
            try {
                task.join();
            } catch (InterruptedException e) {
            }
            String result = task.getResult();
            Log.v("result", result);
            parsingItem(result);
        }

        protected void parsingItem(String result) {//*****************이 메소드 전체

            try {
                if (result != null) {
                    JSONObject root = new JSONObject(result);
                    JSONArray ja = root.getJSONArray("results");
                    String num = root.getString("num_results");

                    for (int i = 0; i < ja.length(); i++) {
                        JSONObject jo = ja.getJSONObject(i);
                        userName = jo.getString("userName");
                        userPhn = jo.getString("tel");
                        address1 = jo.getString("address1");
                        address2 = jo.getString("address2");
                        zipcode = jo.getString("zipcode");
                    }
                }

            } catch (JSONException e) {
                e.printStackTrace();
            }
        }
    }
    protected void onActivityResult(int requestCode, int resultCode, Intent data){
        if(resultCode== RESULT_OK){
            //요청할 때 보낸 요청코드 (3000)
            switch(requestCode) {
                case 3000:
                    zipcodeTV.setText(data.getStringExtra("addr1"));
                    zipcodeTV.setEnabled(false);
                    addrTV1.setText(data.getStringExtra("addr2"));
                    addrTV1.setEnabled(false);
                    break;
            }
        }
    }

    public boolean isCellphone(String str) {
        return str.matches("(01[016789])(\\d{3,4})(\\d{4})");
    }
}
