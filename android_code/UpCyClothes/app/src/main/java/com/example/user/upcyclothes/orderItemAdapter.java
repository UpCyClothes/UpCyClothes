package com.example.user.upcyclothes;


import android.content.Context;
import android.content.res.Resources;
import android.support.v4.content.ContextCompat;
import android.support.v7.app.AlertDialog;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.BaseAdapter;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.TextView;


public class orderItemAdapter extends ArrayAdapter implements View.OnClickListener {

    private String[] orderID;
    private String[] productName;
    private String[] productNameList;
    private String[] receiverName;
    private String[] addr1;
    private String[] addr2;
    private String[] receiverPhn;
    private String[] quantity;
    private String[] date;
    private String[] totPrice;
    private String[] status;

    final Context context = null;
    View cvtView = null;
    Button deleteBtn;

    public interface ListBtnClickListener {
        void onListBtnClick(int position);
    }


    // 생성자로부터 전달된 resource id 값을 저장.
    int resourceId;
    // 생성자로부터 전달된 ListBtnClickListener  저장.
    private ListBtnClickListener listBtnClickListener;


    // ListViewBtnAdapter 생성자. 마지막에 ListBtnClickListener 추가.
    orderItemAdapter(Context context, int resource, String[] s1, String[] s2, String[] s3, String s4[], String[] s5, String[] s6, String[] s7, String[] s8, String[] s9, String[] s10, ListBtnClickListener clickListener) {
        super(context, resource);

        // resource id 값 복사. (super로 전달된 resource를 참조할 방법이 없음.)
        this.resourceId = resource;

        this.listBtnClickListener = clickListener;
        this.orderID = s1;
        this.productName = s2;
        this.receiverName = s3;
        this.addr1 = s4;
        this.addr2 = s5;
        this.receiverPhn = s6;
        this.quantity = s7;
        this.date = s8;
        this.totPrice = s9;
        this.status = s10;
    }

    @Override
    public int getCount() {
        return orderID.length;
    }

    @Override
    public String[] getItem(int pos) {
        String[] item = new String[9];
        item[0] = orderID[pos];
        item[1] = productName[pos];
        item[2] = receiverName[pos];
        item[3] = addr1[pos];
        item[4] = addr2[pos];
        item[5] = receiverPhn[pos];
        item[6] = quantity[pos];
        item[7] = date[pos];
        item[8] = totPrice[pos];
        item[9] = status[pos];
        return item;
    }

    @Override
    public long getItemId(int pos) {
        return pos;
    }

    @Override
    public View getView(int position, View convertView, ViewGroup parent) {
        final int pos = position;
        final Context context = parent.getContext();

        cvtView = convertView;
        // 생성자로부터 저장된 resourceId(listview_btn_item)에 해당하는 Layout을 inflate하여 convertView 참조 획득.
        if (convertView == null) {
            LayoutInflater inflater = (LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
            cvtView = inflater.inflate(this.resourceId/*R.layout.activity_cart_item*/, parent, false);
        }
        //(cartItem).setData(itemName[pos],price[pos],amount[pos],url[pos]);
//        // 화면에 표시될 View(Layout이 inflate된)로부터 위젯에 대한 참조 획득
        final TextView orderIDTV = (TextView) cvtView.findViewById(R.id.orderIDTV);
        final TextView dateTV = (TextView) cvtView.findViewById(R.id.dateTV);
        final TextView itemNameTV = (TextView) cvtView.findViewById(R.id.itemNameTV);
        final TextView detailtemNameTV = (TextView) cvtView.findViewById(R.id.detailtemNameTV);
        final LinearLayout detailL = (LinearLayout) cvtView.findViewById(R.id.detailL);

        final TextView priceTV = (TextView) cvtView.findViewById(R.id.priceTV);
        final TextView amountTV = (TextView) cvtView.findViewById(R.id.amountTV);
        final TextView addrTV = (TextView) cvtView.findViewById(R.id.addrTV);
        final TextView phnTV = (TextView) cvtView.findViewById(R.id.phnTV);

        final TextView statusTV = (TextView) cvtView.findViewById(R.id.statusTV);

        orderIDTV.setText("주문번호 #" + orderID[pos]);
        if (status[pos].contains("1")) {
            statusTV.setText("상태 : 주문접수");
        }
        if (status[pos].contains("2")) {
            statusTV.setText("상태 : 입금확인");
        }
        if (status[pos].contains("3")) {
            statusTV.setText("상태 : 배송 준비중");
        }
        if (status[pos].contains("4")) {
            statusTV.setText("상태 : 배송 시작");
        }
        if (status[pos].contains("5")) {
            statusTV.setText("상태 : 배송 완료");
        }
        dateTV.setText(date[pos]);
        productNameList = productName[pos].split(":");
        if (productNameList.length == 1) {
            itemNameTV.setText("제품이름 : " + productName[pos]);
        } else {
            itemNameTV.setText("제품이름 : " + productNameList[0] + " 외 " + productNameList.length + "개");
        }
        priceTV.setText("가격 : " + totPrice[pos] + "원");
        amountTV.setText("수량 : " + quantity[pos] + "개");
        addrTV.setText("주소 : " + addr1[pos] + " " + addr2[pos]);
        phnTV.setText("받는사람정보 : " + receiverName[pos] + "/" + receiverPhn[pos]);
        String s = "";

        for (int i = 0; i < productNameList.length; i++) {
            if (i == productNameList.length - 1) {
                s = s.concat(productNameList[i]);
            } else s = s.concat(productNameList[i] + "\n");
        }

        detailtemNameTV.setText(s);
        itemNameTV.setOnClickListener(new Button.OnClickListener() {
            public void onClick(View v) {
                    if (detailL.getVisibility() == View.VISIBLE) {
                        detailL.setVisibility(cvtView.GONE);
                    } else {
                        detailL.setVisibility(cvtView.VISIBLE);
                    }

            }
        });
        // button2의 TAG에 position값 지정. Adapter를 click listener로 지정.
        Button deleteBtn = (Button) cvtView.findViewById(R.id.deleteBtn);
        deleteBtn.setTag(position);
        deleteBtn.setOnClickListener(this);

        return cvtView;
    }

    // deleteBtn이  눌려졌을 때 실행되는 onClick함수.
    public void onClick(View v) {
        // ListBtnClickListener(MainActivity)의 onListBtnClick() 함수 호출.
        if (status[(int) v.getTag()].contains("1")) {
            if (this.listBtnClickListener != null) {
                this.listBtnClickListener.onListBtnClick((int) v.getTag());
            }
        } else {
            if (this.listBtnClickListener != null) {
                this.listBtnClickListener.onListBtnClick(3000);
            }
        }
    }

}

