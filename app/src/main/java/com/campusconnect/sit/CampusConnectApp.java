package com.campusconnect.sit;

import android.support.multidex.MultiDex;
import android.support.multidex.MultiDexApplication;

import com.androidnetworking.AndroidNetworking;


public class CampusConnectApp extends MultiDexApplication {

    private static CampusConnectApp istance;

    @Override
    public void onCreate() {
        super.onCreate();
        istance = this;
        AndroidNetworking.initialize(this);
        MultiDex.install(this);
    }

    /**
     * Instance of this class
     * @return
     */
    public static CampusConnectApp getIstance() {
        return istance;
    }

}
