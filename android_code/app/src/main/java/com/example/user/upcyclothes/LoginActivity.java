package com.example.user.upcyclothes;

import android.app.Activity;
import android.app.AlertDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.net.ConnectivityManager;
import android.os.Build;
import android.os.Bundle;
import android.text.InputType;
import android.util.Log;
import android.view.View;
import android.webkit.CookieManager;
import android.webkit.CookieSyncManager;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.TextView;
import org.json.JSONException;
import org.json.JSONObject;


public class LoginActivity extends Activity {
    //IDInformation id;
    private String user_id, user_pw;
    private String success="0";
    private Button loginBtn;
    private Button joinBtn ;
    private TextView chkTV;

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
                    Log.v("메인엑티비티에 유저아이디","세팅");
                    Intent resultIntent = new Intent(LoginActivity.this,MainActivity.class);
                    resultIntent.putExtra("sessID",cookieString);
                    startActivity(resultIntent);
                    finish();

                }
                else {
                    //실패시 회원정보를 확인하세요! 를 보여준다.
                    chkTV.setVisibility(View.VISIBLE);
                    chkTV.setText(success);

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
            //Log.v("이제 파싱할거에요",result);
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
                }
                //Log.v("json 파싱결과", list+"");
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

