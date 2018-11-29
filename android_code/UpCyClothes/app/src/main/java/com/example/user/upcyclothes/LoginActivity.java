package com.example.user.upcyclothes;

import android.app.Activity;
import android.app.AlertDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.net.ConnectivityManager;
import android.os.Build;
import android.os.Bundle;
import android.support.design.widget.NavigationView;
import android.support.v4.view.GravityCompat;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.ActionBarDrawerToggle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.text.InputType;
import android.util.Log;
import android.view.MenuItem;
import android.view.View;
import android.webkit.CookieManager;
import android.webkit.CookieSyncManager;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.toolbox.Volley;
import com.google.firebase.iid.FirebaseInstanceId;

import org.json.JSONException;
import org.json.JSONObject;


public class LoginActivity extends AppCompatActivity
        implements NavigationView.OnNavigationItemSelectedListener {
    static boolean designerFlag=false;
    static String designNick;
    private String user_id, user_pw;
    private String success="0";
    private Button loginBtn;
    private Button joinBtn ;
    private TextView chkTV;
    private String token;
    private String cookieString="";
    private CookieManager cookieManager;
    private String url="https://upcyclothes.duckdns.org";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);
        /*Initial*/

        //네트워크 상태 체크
        if(NetworkConnection() == false){
            NotConnected_showAlert();
        }


        final EditText inputId = (EditText) findViewById(R.id.idET);
        final EditText inputPW = (EditText) findViewById(R.id.pwET);
        inputPW.setInputType(InputType.TYPE_CLASS_TEXT| InputType.TYPE_TEXT_VARIATION_PASSWORD);

        chkTV=(TextView)findViewById(R.id.chkTV);
        loginBtn = (Button) findViewById(R.id.loginBtn);
        joinBtn=(Button)findViewById(R.id.registerBtn) ;


        //쿠키//
        CookieSyncManager.createInstance(this);
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.LOLLIPOP_MR1) {
            CookieManager.getInstance().removeAllCookies(null);
            CookieManager.getInstance().flush();
        } else {
            CookieSyncManager cookieSyncMngr = CookieSyncManager.createInstance(this);
            cookieSyncMngr.startSync();
            cookieManager.removeAllCookie();
            cookieManager.removeSessionCookie();
            cookieSyncMngr.stopSync();
            cookieSyncMngr.sync();
        }
        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);

        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);

        ActionBarDrawerToggle toggle = new ActionBarDrawerToggle(
                this, drawer, toolbar, R.string.navigation_drawer_open, R.string.navigation_drawer_close);
        toggle.getDrawerArrowDrawable().setColor(getColor(R.color.colorMain));

        drawer.addDrawerListener(toggle);
        toggle.syncState();

        NavigationView navigationView = (NavigationView) findViewById(R.id.nav_view);
        navigationView.setNavigationItemSelectedListener(this);


        //툴바의 버튼
        // final ImageView alarmBtn= (ImageView) findViewById(R.id.alarmBtn);
        final ImageView cartBtn= (ImageView) findViewById(R.id.cartBtn);
        final ImageView personBtn= (ImageView) findViewById(R.id.personBtn);
        //새로운 문의가 있을 경우에 보여지고 없으면 안보여진다.

        //툴바 버튼리스너
        personBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Toast.makeText(getApplicationContext(),"로그인이 필요한 서비스입니다.",Toast.LENGTH_LONG).show();
                return;
            }
        });
        cartBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Toast.makeText(getApplicationContext(),"로그인이 필요한 서비스입니다.",Toast.LENGTH_LONG).show();
                return;
            }
        });
        /*Click Login Btn*/
        loginBtn.setOnClickListener(new Button.OnClickListener() {
            @Override
            public void onClick(View view) {
                user_id = inputId.getText().toString();
                user_pw = inputPW.getText().toString();

                /*Check Id and Password Part..*/

                LetsConnect login = new LetsConnect(); //log in check
                success = login.Belogged(user_id, user_pw);


                //로그인 성공시 다시 홈 액티비티로
                if(success.equals("1")) {
                    MainActivity.userID=user_id;
                    //현재 데이터베이스에 유저 row에 token 값 넣기 (맨처음 로그인일 경우만)
                    token=FirebaseInstanceId.getInstance().getToken();

                    Response.Listener<String> responseListener = new Response.Listener<String>() {

                        @Override
                        public void onResponse(String response) {
                            try
                            {
                                Log.v("response",response);
                                JSONObject jsonResponse = new JSONObject(response);
                                boolean success = jsonResponse.getBoolean("success");
                                if (success) {
                                    Log.v("메인엑티비티에 유저아이디","세팅");
                                    Intent resultIntent = new Intent();
                                    resultIntent.putExtra("sessID",cookieString);
                                    setResult(RESULT_OK,resultIntent);
                                    finish();

                                }
                                else{

                                }
                            }
                            catch (Exception e){
                                e.printStackTrace();
                            }
                        }
                    };
                    RegisterRequest registerRequest = new RegisterRequest(MainActivity.userID, token, responseListener);
                    RequestQueue queue = Volley.newRequestQueue(LoginActivity.this);
                    queue.add(registerRequest);


                }
                else {
                    Log.v("로그인정보 잘못됨.",success);
                    //실패시 회원정보를 확인하세요! 를 보여준다.
                    chkTV.setText(success);
                    chkTV.setVisibility(View.VISIBLE);

                }

            }
        });

        /*Click Signup Button*/

        joinBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(LoginActivity.this, SignupActivity.class);
                startActivity(intent);
            }
        });

    }

    @Override
    public boolean onNavigationItemSelected(MenuItem item) {
        // Handle navigation view item clicks here.
        int id = item.getItemId();

        if (id == R.id.nav_new) {
            // Handle the camera action
            Intent intent = new Intent(LoginActivity.this, NewActivity.class);
            startActivity(intent);
        } else if (id == R.id.nav_clo) {
            Intent intent = new Intent(LoginActivity.this, ClothActivity.class);
            startActivity(intent);

        } else if (id == R.id.nav_bag) {
            Intent intent = new Intent(LoginActivity.this, BagActivity.class);
            startActivity(intent);

        } else if (id == R.id.nav_acce) {
            Intent intent = new Intent(LoginActivity.this, AccActivity.class);
            startActivity(intent);

        } else if (id == R.id.nav_shoes) {
            Intent intent = new Intent(LoginActivity.this, ShoesActivity.class);
            startActivity(intent);

        } else if (id == R.id.nav_jewelry) {
            Intent intent = new Intent(LoginActivity.this, JewActivity.class);
            startActivity(intent);

        } else if (id == R.id.nav_material) {
            Intent intent = new Intent(LoginActivity.this, MaterialActivity.class);
            startActivity(intent);
        }else if (id == R.id.nav_notice) {
            Intent intent = new Intent(LoginActivity.this, NoticeActivity.class);
            startActivity(intent);
        } else if (id == R.id.nav_commu) {
            Intent intent = new Intent(LoginActivity.this, CommunityActivity.class);
            startActivity(intent);

        }else if (id == R.id.nav_messen) {
            Intent intent = new Intent(LoginActivity.this, MessengerActivity.class);
            startActivity(intent);
        }

        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        drawer.closeDrawer(GravityCompat.START);
        return true;
    }
    private class LetsConnect {
        private int s_id = 0;

        protected String Belogged(String id, String pw) {
            String postParameters = "id=" + id + "&pw=" + pw ;
            URLConnector task = new URLConnector(url,"/android/login.php", postParameters);
            int flag = 0;
            task.start();

            try {

                // System.out.println("log in...");
                task.join();
            } catch (InterruptedException e) {
            }

            String result = task.getResult();

            ParseData parse = new ParseData();
            success = parse.ParsingLogin(result);

            return success;
        }


        protected int getId() {
            return s_id;
        }
    }


    private class ParseData {

        protected String ParsingLogin(String result) {//*****************이 메소드 전체
            String list ="";
            Log.v("로그인 파싱할거에요",result);
            try {
                result=result.trim();
                if(result.contains("&")){
                    String[] temp=result.split("&");
                    //
                    result=temp[0];
                    cookieString=temp[1];
                    //cookieManager.setCookie(url,cookieString);
                    //Log.v("세팅된 쿠키는",cookieString);

                }

                JSONObject root = new JSONObject(result);
                //JSONArray jsonArray = root.getJSONArray(TAG_JSON);
                String status = "";
                status = root.getString("status");
                if (status.equals("error")) list=root.getString("memo");
                else { //status:OK
                    //Log.v("status OK로 들어옴",": ");
                    list=root.getString("memo");
                    designNick=root.getString("nickname");
                    if(root.getString("usertype").equals("0")){
                        designerFlag=true;
                    }
                    else designerFlag=false;
                }
                Log.v("login json 파싱결과", list+"");
            } catch (JSONException e) {
                e.printStackTrace();
            }
            return list;
        }
    }
    private void NotConnected_showAlert() {
        AlertDialog.Builder builder = new AlertDialog.Builder(LoginActivity.this);
        builder.setTitle("네트워크 연결 오류");
        builder.setMessage("사용 가능한 무선네트워크가 없습니다.\n" + "먼저 무선네트워크 연결상태를 확인해 주세요.")
                .setCancelable(false)
                .setPositiveButton("확인", new DialogInterface.OnClickListener() {
                    public void onClick(DialogInterface dialog, int id) {
                        finish(); // exit
                        //application 프로세스를 강제 종료
                        android.os.Process.killProcess(android.os.Process.myPid() );
                    }
                });
        AlertDialog alert = builder.create();
        alert.show();
    }

    private boolean NetworkConnection() {
        ConnectivityManager manager = (ConnectivityManager) getSystemService (Context.CONNECTIVITY_SERVICE);
        boolean isMobileAvailable = manager.getNetworkInfo(ConnectivityManager.TYPE_MOBILE).isAvailable();
        boolean isMobileConnect = manager.getNetworkInfo(ConnectivityManager.TYPE_MOBILE).isConnectedOrConnecting();
        boolean isWifiAvailable = manager.getNetworkInfo(ConnectivityManager.TYPE_WIFI).isAvailable();
        boolean isWifiConnect = manager.getNetworkInfo(ConnectivityManager.TYPE_WIFI).isConnectedOrConnecting();

        if ((isWifiAvailable && isWifiConnect) || (isMobileAvailable && isMobileConnect)){
            return true;
        }else{
            return false;
        }
    }
    @Override
    protected void onResume()
    {
        super.onResume();
        CookieSyncManager.getInstance().startSync();
    }

    @Override
    protected void onPause()
    {
        super.onPause();
        CookieSyncManager.getInstance().stopSync(); // 동기화 종료
    }
}

