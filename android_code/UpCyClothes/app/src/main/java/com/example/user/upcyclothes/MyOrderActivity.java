package com.example.user.upcyclothes;

import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.util.Log;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.ListView;
import android.widget.Toast;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

public class MyOrderActivity  extends AppCompatActivity implements orderItemAdapter.ListBtnClickListener {
    private String user_ID;
    private String[]  p_orderID_list;
    private String[]  p_status_list;
    private String[] p_date_list;
    private  String[] p_productName_list;
    private  String[] p_productPrice_list;
    private  String[] p_productQuantity_list;
    private  String[] p_receiverName_list;
    private   String[] p_receiverPhn_list;
    private  String[] p_addr1_list;
    private  String[] p_addr2_list;

    private AlertDialog dialog;


    @Override
    public void onListBtnClick(int position) {
        //이 아이템을 주문내역에서 삭제하면 됩니다.
        //Toast.makeText(this, Integer.toString(position+1) + " Item is selected for delete..", Toast.LENGTH_SHORT).show() ;
        if(position==3000){
            android.support.v7.app.AlertDialog.Builder builder = new android.support.v7.app.AlertDialog.Builder(MyOrderActivity.this);
            dialog = builder.setMessage("주문 확인 이외의 상태에서는 주문취소가 불가능합니다.")
                    .setNegativeButton("OK", null)
                    .create();
            dialog.show();
            return;
        }
        else {
            Log.v("삭제할 아이템 아이디", p_orderID_list[position] + "");

            LetsConnect letsConnect = new LetsConnect();
            letsConnect.deleteItemInfo(p_orderID_list[position]);
        }
    }

    @Override
    public void onCreate(Bundle savedInstanceState)
    {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_my_order);
            user_ID=MainActivity.userID;
            //현재 로그인된 유저의 주문 정보 받기
            LetsConnect c = new LetsConnect();
            c.getItemInfo();



            ListView listView = (ListView) findViewById(R.id.listview);

        //주문정보가 없을 경우
        LinearLayout emptyL = (LinearLayout)findViewById(R.id.emptyL);
        if(p_orderID_list.length==0){
            emptyL.setVisibility(View.VISIBLE);
            listView.setVisibility(View.INVISIBLE);

        }
            orderItemAdapter adapter= new orderItemAdapter(this,R.layout.activity_order_item,p_orderID_list
                    ,p_productName_list,p_receiverName_list,p_addr1_list,p_addr2_list,p_receiverPhn_list,p_productQuantity_list,p_date_list,p_productPrice_list,p_status_list,this);
            listView.setAdapter(adapter);

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
                    Intent intent = new Intent(MyOrderActivity.this, MypageActivity.class);
                    //intent.putExtra("sauce name",name );
                    //intent.putExtra("userID",userID);
                    startActivity(intent);
                }

        });
        cartBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

                    Intent intent = new Intent(MyOrderActivity.this, MycartActivity.class);
                    startActivity(intent);
                }

        });

    }

    private class LetsConnect {

        protected void getItemInfo( ) {
            URLConnector task = new URLConnector("https://upcyclothes.duckdns.org", "/android/orderList.php", "user_ID="+user_ID,false);

            Log.v("task",task.toString());
            task.start();
            try {
                task.join();
            } catch (InterruptedException e) {            }
            String result = task.getResult();
            Log.v("result",result);
            parsingItem(result);
            //Log.v("p_name",p_name_list[0]);
            //Log.v("p_name",p_name_list[1]);
            //Log.v("p_name",p_name_list[2]);
        }
        protected void deleteItemInfo( String orderID) {
            //주문 상태가 주문 준비중 (orderstate==1)일 경우에만 삭제가 가능함.
            URLConnector task = new URLConnector("https://upcyclothes.duckdns.org", "/android/deleteOrderInfo.php", "orderID="+orderID,false);

            Log.v("task",task.toString());
            task.start();
            try {
                task.join();
            } catch (InterruptedException e) {            }
            String result = task.getResult();
            //Log.v("result",result);
            try
            {
                Log.v("result",result);
                JSONObject jsonResponse = new JSONObject(result);
                boolean success = jsonResponse.getBoolean("success");
                if (success) {
                    android.support.v7.app.AlertDialog.Builder builder = new android.support.v7.app.AlertDialog.Builder(MyOrderActivity.this);
                    dialog = builder.setMessage("주문내역에서 삭제되었습니다!").setPositiveButton("OK", new DialogInterface.OnClickListener() {
                        @Override
                        public void onClick(DialogInterface dialogInterface, int i) {
                            Intent intent1 = new Intent(MyOrderActivity.this,MyOrderActivity.class);
                            startActivity(intent1);
                            finish();
                        }
                    }).create();
                    dialog.show();

                }
                else{
                    android.support.v7.app.AlertDialog.Builder builder = new android.support.v7.app.AlertDialog.Builder(MyOrderActivity.this);
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
        protected void parsingItem(String result) {//*****************이 메소드 전체

            Log.v("이제 아이템 파싱할거에요",result);
            try {
                if (result != null) {
                    JSONObject root = new JSONObject(result);
                    JSONArray ja = root.getJSONArray("results");
                    String num= root.getString("num_results");
                    p_orderID_list=new String[Integer.parseInt(num)];
                    p_status_list=new String[Integer.parseInt(num)];
                    p_productName_list=new String[Integer.parseInt(num)];
                    p_productQuantity_list=new String[Integer.parseInt(num)];
                    p_productPrice_list=new String[Integer.parseInt(num)];
                    p_date_list=new String[Integer.parseInt(num)];
                    p_receiverName_list=new String[Integer.parseInt(num)];
                    p_receiverPhn_list=new String[Integer.parseInt(num)];
                    p_addr1_list=new String[Integer.parseInt(num)];
                    p_addr2_list=new String[Integer.parseInt(num)];

                    for (int i = 0; i < ja.length(); i++) {
                        JSONObject jo =ja.getJSONObject(i);

                        p_orderID_list[i]=jo.getString("orderID");
                        p_status_list[i]=jo.getString("orderState");
                        p_productName_list[i]=jo.getString("productName");
                        p_productQuantity_list[i]=jo.getString("quantity");
                        p_productPrice_list[i]=jo.getString("totalprice");
                        p_date_list[i]=jo.getString("date");
                        p_receiverName_list[i]=jo.getString("receiverName");
                        p_receiverPhn_list[i]=jo.getString("receiverTel");
                        p_addr1_list[i]=jo.getString("receiverAddress1");
                        p_addr2_list[i]=jo.getString("receiverAddress2");
                    }
                }

            }
            catch (JSONException e) {
                e.printStackTrace();
            }
        }
    }


}