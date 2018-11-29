package com.example.user.upcyclothes;

import android.content.DialogInterface;
import android.content.Intent;
import android.graphics.Bitmap;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.util.DisplayMetrics;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.Button;
import android.widget.GridView;
import android.widget.ImageView;
import android.widget.ListAdapter;
import android.widget.ListView;
import android.widget.Toast;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

/**
 * Created by user on 2018-10-11.
 */

public class MycartActivity  extends AppCompatActivity implements cartItemAdapter.ListBtnClickListener {
    String[]  p_cartid_list;
    String[] p_id_list;
    String[] p_name_list;
    String[] p_price_list;
    String[] p_amount_list;
    String[] p_url_list;

    private String user_ID;
    private AlertDialog dialog;


//    DisplayMetrics mMetrics;
//    View v;


    private ListView.OnItemClickListener listviewOnItemClickListener
            = new ListView.OnItemClickListener() {

        public void onItemClick(AdapterView<?> arg0, View arg1, int arg2,
                                long arg3) {

//            Toast.makeText(MycartActivity.this,
//                    arg2+"번 아이템 선택되었다.",
//                    Toast.LENGTH_LONG).show();

            Intent intent = new Intent(MycartActivity.this, DetailActivity.class);

            //intent.putExtra("category","accessory");
            intent.putExtra("item id",p_id_list[arg2]);
            intent.putExtra("item name",p_name_list[arg2]);
            intent.putExtra("item amount",p_amount_list[arg2]);
            intent.putExtra("item price",p_price_list[arg2]);
            intent.putExtra("item url",p_url_list[arg2]);
            startActivity(intent);
        }
    };

    @Override
    public void onListBtnClick(int position) {
        //이 아이템을 장바구니에서 삭제하면 됩니다.
        Toast.makeText(this, Integer.toString(position+1) + " Item is selected for delete..", Toast.LENGTH_SHORT).show() ;
        Log.v("삭제할 아이템 아이디",p_cartid_list[position]+"");
        LetsConnect letsConnect = new LetsConnect();
        letsConnect.deleteItemInfo(p_cartid_list[position]);

    }

    @Override
    public void onCreate(Bundle savedInstanceState)
    {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_mycart);

        if(MainActivity.userID==null){
            //로그인이 필요한 서비스입니다. 창 띄워주기.
            Log.v("userid는  ",user_ID+"없다.");
            new android.app.AlertDialog.Builder(this)
                    .setIcon(android.R.drawable.ic_dialog_alert)
                    .setTitle("알림")
                    .setMessage("로그인이 필요한 서비스입니다.")
                    .setPositiveButton("Yes", new DialogInterface.OnClickListener()
                    {
                        @Override
                        public void onClick(DialogInterface dialog, int which) {
                            Intent intent = new Intent(MycartActivity.this, LoginActivity.class);
                            startActivity(intent);
                        }
                    })
                    .show();

        }
        else{
            user_ID=MainActivity.userID;
            Log.v("userid는 ",user_ID+"");
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
                        Intent intent = new Intent(MycartActivity.this, MypageActivity.class);
                        //intent.putExtra("sauce name",name );
                        //intent.putExtra("userID",userID);
                        startActivity(intent);

                }
            });
            cartBtn.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View view) {
                    Toast.makeText(MycartActivity.this,"현재 페이지입니다.",Toast.LENGTH_LONG).show();
                    return;

                    }

            });
            LetsConnect c = new LetsConnect();
            c.getItemInfo();


            ListView listView = (ListView) findViewById(R.id.listview);

            cartItemAdapter adapter= new cartItemAdapter(this,R.layout.activity_cart_item,p_name_list,p_price_list,p_amount_list,p_url_list,this);
            listView.setAdapter(adapter);
            listView.setOnItemClickListener(listviewOnItemClickListener);

            Button selectiveOrderBtn= (Button)findViewById(R.id.selectiveOrderBtn);
            selectiveOrderBtn.setOnClickListener(new View.OnClickListener(){
                @Override
                public void onClick(View view) {
                    //하나인 경우, 2개이상인 경우 나눠서
                    Intent intent =  new Intent( MycartActivity.this, NextOrderActivity.class);
                    String s1="";
                    String s2="";
                    String s3="";
                    int s4=0;
                    String s5="";
                    for(int i=0;i<p_id_list.length;i++){
                        if(cartItemAdapter.selectChk[i]==true){
                            s1=s1.concat(p_id_list[i]+":");
                            s2=s2.concat(p_amount_list[i]+":");
                            s3=s3.concat(p_name_list[i]+":");
                            s4+=Integer.parseInt(p_price_list[i]);
                            s5=s5.concat(p_cartid_list[i]+":");
                        }
                    }
                    if(s1.equals("")){
                        //선택된 물건이 없으므로 주문 진행 불가하다고 알림
                        android.support.v7.app.AlertDialog.Builder builder = new android.support.v7.app.AlertDialog.Builder(MycartActivity.this);
                        dialog = builder.setMessage("선택된 물건이 없으므로 주문 진행이 불가합니다.")
                                .setNegativeButton("OK", null)
                                .create();
                        dialog.show();
                        return;
                    }
                    //맨 마지막에도 : 이 들어가므로 마지막 :은 없애준다.
                    s1=s1.substring(0,s1.length()-1);
                    s2=s2.substring(0,s2.length()-1);
                    s3=s3.substring(0,s3.length()-1);
                    s5=s5.substring(0,s5.length()-1);

                    intent.putExtra("productID",s1 );
                    intent.putExtra("productCount",s2 );
                    intent.putExtra("productName",s3);
                    intent.putExtra("productTotPrice",s4);
                    intent.putExtra("cartIdList",s5);

                    Log.v("장바구니 넘겨주는 정보(선택)",s1+s2+s3+s4+s5);
                    startActivity(intent);
                    finish();

                }
            });
            Button allOrderBtn= (Button)findViewById(R.id.allOrderBtn);
            allOrderBtn.setOnClickListener(new View.OnClickListener(){
                @Override
                public void onClick(View view) {
                    Intent intent =  new Intent( MycartActivity.this, NextOrderActivity.class);
                    String s1="";
                    String s2="";
                    String s3="";
                    int s4=0;
                    String s5="";
                    for(int i=0;i<p_id_list.length;i++){
                            s1=s1.concat(p_id_list[i]+":");
                            s2=s2.concat(p_amount_list[i]+":");
                            s3=s3.concat(p_name_list[i]+":");
                            s4+=Integer.parseInt(p_price_list[i]);
                            s5=s5.concat(p_cartid_list[i]+":");
                        Log.v("장바구니아이디",p_cartid_list[i]);
                        }

                    //맨 마지막에도 : 이 들어가므로 마지막 :은 없애준다.
                    s1=s1.substring(0,s1.length()-1);
                    s2=s2.substring(0,s2.length()-1);
                    s3=s3.substring(0,s3.length()-1);
                    s5=s5.substring(0,s5.length()-1);

                    intent.putExtra("productID",s1 );
                    intent.putExtra("productCount",s2 );
                    intent.putExtra("productName",s3);
                    intent.putExtra("productTotPrice",s4);
                    intent.putExtra("cartIdList",s5);


                   Log.v("장바구니 넘겨주는 정보 (전부)",s1+s2+s3+s4+s5);
                    //장바구니에서 주문 완료되면 장바구니에서 삭제.
                    startActivity(intent);
                    finish();
                }
            });
        }


    }

    private class LetsConnect {

        protected void getItemInfo( ) {
            URLConnector task = new URLConnector("https://upcyclothes.duckdns.org", "/android/cartInfo.php", "user_ID="+user_ID,false);

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
        protected void deleteItemInfo( String mycartID) {
            URLConnector task = new URLConnector("https://upcyclothes.duckdns.org", "/android/deleteInfo.php", "mycartID="+mycartID,false);

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
                    android.support.v7.app.AlertDialog.Builder builder = new android.support.v7.app.AlertDialog.Builder(MycartActivity.this);
                    dialog = builder.setMessage("장바구니에서 삭제되었습니다!").setPositiveButton("OK", new DialogInterface.OnClickListener() {
                        @Override
                        public void onClick(DialogInterface dialogInterface, int i) {
                            Intent intent1 = new Intent(MycartActivity.this,MycartActivity.class);
                            startActivity(intent1);
                            finish();
                        }
                    }).create();
                    dialog.show();

                }
                else{
                    android.support.v7.app.AlertDialog.Builder builder = new android.support.v7.app.AlertDialog.Builder(MycartActivity.this);
                    dialog = builder.setMessage("Failed - Try One more!")
                            .setNegativeButton("OK", null)
                            .create();
                    dialog.show();
                }
            }
            catch (Exception e){
                e.printStackTrace();
            }
            //Log.v("p_name",p_name_list[0]);
            //Log.v("p_name",p_name_list[1]);
            //Log.v("p_name",p_name_list[2]);
        }
        protected void parsingItem(String result) {//*****************이 메소드 전체

            Log.v("이제 아이템 파싱할거에요",result);
            try {
                if (result != null) {
                    JSONObject root = new JSONObject(result);
                    JSONArray ja = root.getJSONArray("results");
                    String num= root.getString("num_results");
                    p_cartid_list=new String[Integer.parseInt(num)];
                    p_name_list=new String[Integer.parseInt(num)];
                    p_id_list=new String[Integer.parseInt(num)];
                    p_amount_list=new String[Integer.parseInt(num)];
                    p_price_list=new String[Integer.parseInt(num)];
                    p_url_list=new String[Integer.parseInt(num)];

                    for (int i = 0; i < ja.length(); i++) {
                        JSONObject jo =ja.getJSONObject(i);

                        p_cartid_list[i]=jo.getString("mycartID");
                        p_id_list[i]=jo.getString("productID");
                        p_name_list[i]=jo.getString("productName");
                        p_amount_list[i]=jo.getString("count");
                        p_price_list[i]=jo.getString("price");
                        p_url_list[i]="https://upcyclothes.duckdns.org" + jo.getString("productURL");
                    }
                }

            }
            catch (JSONException e) {
                e.printStackTrace();
            }
        }
    }


}
