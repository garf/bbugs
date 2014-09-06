//---------------------------------------------------------------------------------------
#property link                         "http://mydoubletrend.com/"
#property copyright                    "2014 Double Trend IT Technologies. www.myDoubleTrend.com"
#property version                      "5.0"
#property icon                         "\\Images\\dt.ico"
#property description                  "Благодарим Вас за использование нашего робота."
#property description                  "Компания Double Trend всегда работает над улучшением качества услуг."
#property description                  "Если у вас возникли какие либо вопросы или предложения, мы с радостью готовы их выслушать."
#property description                  "Связаться с нами можно следующими способами:"
#property description                  "E-mail: support@mydoubletrend.com"
#property description                  "Телефоны: 8(800) 775-61-38, 8(499) 398-15-33"
#property description                  "--"
#property description                  "С наилучшими пожеланиями,"
#property description                  "компания Double Trend"
#define           SCHEME_NAME          "2014 Double Trend v5.0"
#define           LOG_PREFIX           "DT5_"
#define           GBL_PREFIX           "DT50_"
#define           IND                  "Ma_in_colo"
#define           ATT                     3     // попытки частичного закрытия прибыли
//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

#include <InternetLib.mqh>
#include <md51.mqh>
#include <hash.mqh>
#include <json.mqh>

//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
   extern   string   LicenceKey        = ""; //Лицензионный ключ
            string   Version           = "5.0";
            string   Broker            = "instaforex";
            string   secret1           = "5478-JHtdGRavwPn84gh-iGer338365jIlebTHpVAr-JJ";
            string   secret2           = "8hhG-jdh6hheyfbHGbaT-qoIJdns672GYs529yUjhc-6G";
            bool     isHardStop        = false;
            bool     tradeAllowMessage = false;
            bool     dllMessage        = false;
            bool     expiryMessage     = false;
            
            bool     doReinit          = false;
            
            uint     licenceErrors     = 0;
            
            uint     licenceCounter    = 0;
            uint     paramsCounter     = 0;
            uint     reinitCounter     = 0;
            
            int      licencePeriod    = 3600; // 1 hour
            int      paramsPeriod     = 600;  // 10 minutes
            int      reinitPeriod     = 60;  // 1 minute
   
   //- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
   extern   bool     FINISH=                 false; //Завершить работу
            bool     CUTTING_A=              true;
            bool     CUTTING_B=              true;
            double   q_A=                    7.0;
            double   q_B=                    2.5;
            double   N_A=                   6.0;
            double   N_B=                   3.0;
            string   I___Ticker=          "GBPUSD";
            string   II__Ticker=          "EURUSD";
            string   Ind_TF=              "H1";
            string   Ind_Ticker=          "EURGBP";
            int      MAPeriod=              14;
            int      MAType=                 1;
            int      Step1=                 40;
            int      Step2=                 70;
            int      LinksChangingStep=      3;
            bool     FixLot=                 false;
            double   Lot=                    0.1;
            double   Y=                   2000.0;
            double   K=                      1.2;
            double   MaxTotalLots=           200.0;
            string   Type_close=          "progressive";
            double   n=                     30.0;
            int      ActualTime=           3600;
            string   SOUND=               "news.wav";
            string   OPEN=                "alert.wav";
            string   FAIL=                "timeout.wav";
            bool     DAY=                    false;
            bool     WEEK=                   false;
            bool     MONTH=                  true;
            int      Magic1=              3333333;
            int      Magic2=              7777777;
            
            bool     TEST_LOG=               false;
            int      WI=                     3;
            int      Wait=                 220;
            int      Actl,Hist;
            color    Bull=                   Gold;
            color    Bear=                   OrangeRed;
            color    Buy=                    Blue;
            color    Sel=                    Red;
            color    Win1=                   Magenta;
            color    Win2=                   Gold;
            double   SlipPP=                 4.0;
//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
         int      TFW,ITF,SLIP,DIGT[2],LSTD[4],nn[4],Step,MAG[4],
                  BARS,Bars0,Bars1,Clos0[4],Clos1[4],DF[4],PRT[4],
                  TBM,TSM,TMM,
                    NB[2],        NS[2],
                    TB[2],        TS[2],
                     B[2][4096],   S[2][4096], MTRX[2][4096];
         bool      BMX[2][4096], SMX[2][4096],
                  TST,OPT,ENB,MOD,EXST[4],
                  ce[4],ca[4],cb[4],cs[4],o[2][4],UP[4],DN[4],IEN,SEN,IE,DLT;
         color    WIN[4];
         double   OpnB[2][4096],OpnS[2][4096],
                  LotB[2][4096],LotS[2][4096],
                  PrfB[2][4096],PrfS[2][4096],
                  POIN[2],   //CLOS[2],
                  TotL[2],TLM[2],STLT[2][4],TotProf[4],TotPerc[4],
                  DPR[4],WPR[4],MPR[4],TPR[4],d0[4],dr[4],
                  pVertShift[4],DIST,STEP,REQP[4],DRSA,DRSB, EV, KL,
                  LinkLot[4096],LinkPrf[4096],ClosLot,ClosPrf;
         string   CHART,OPER[8], PC[2][4],PB[2][4],DLOT[4],INST[4],Ty, LOG_FILE[4],
                  SHFT[4],NBY0[4],NBY1[4], NSE0[4],NSE1[4],OVER[4],CMPL[4],PART[4],
                  CLSE[4],PRFC[4],PRFM[4], DRDN[4],DRD0[4],NMAX[4],ITIM[4],IENB[4],
                  OPE[2][4],CLO[2][4],ERR[2][4],PAR[4],PAS[4],Comm[4],PREFIXG;
         datetime TimB[2][4096],TimS[2][4096],
                  CHCK[],CURR,F_UP[4],F_DN[4],NEM,
                  SaveD,OpenD,
                  SaveW,OpenW,
                  Save2,OpenT,
                  Save1,
                  SaveM,OpenM;
//---------------------------------------------------------------------------------------


//------------------------SECURITY-------------------------------------------------------

string requestPOST(string domain, string uri, string params)
{
   //Print(params);
   MqlNet INet;
   if (!INet.Open(domain, 80, "", "", INTERNET_SERVICE_HTTP)) 
      return("-1");
   string headers="Content-Type: text/plain";
   tagRequest req;
   req.Init("POST", uri, headers, params, false, NULL, false);
   if(!INet.Request(req)) {
      return("-1");
   } else {
      //Print(req.stOut);
      return(req.stOut);
   }
}

string compileParams(string data)
{
   string m1 = (string)countOrdersByMagic(Magic1);
   string m2 = (string)countOrdersByMagic(Magic2);
   return data + "&balance=" + (string)AccountBalance()
      + "&equity=" + (string)AccountEquity()
      + "&leverage=" + (string)AccountLeverage()
      + "&margin=" + (string)AccountMargin()
      + "&profit=" + (string)AccountProfit()
      + "&digits=" + (string)Digits()
      + "&account=" + (string)AccountNumber()
      + "&key=" + LicenceKey
      + "&broker=" + (string)Broker
      + "&currency=" + (string)AccountCurrency()
      + "&version=" + (string)Version
      + "&finish=" + boolToStr(FINISH)
      + "&errors=" + licenceErrors
      + "&demo=" + boolToStr(IsDemo())
      + "&m1=" + m1
      + "&m2=" + m2
      + "&CUTTING_A=" + boolToStr(CUTTING_A)
      + "&CUTTING_B=" + boolToStr(CUTTING_B)
      + "&q_A=" + DoubleToStr(q_A)
      + "&q_B=" + DoubleToStr(q_B)
      + "&N_A=" + DoubleToStr(N_A)
      + "&N_B=" + DoubleToStr(N_B)
      + "&I___Ticker=" + I___Ticker
      + "&II__Ticker=" + II__Ticker
      + "&Ind_TF=" + Ind_TF
      + "&Ind_Ticker=" + Ind_Ticker
      + "&MAPeriod=" + IntegerToString(MAPeriod)
      + "&MAType=" + IntegerToString(MAType)
      + "&Step1=" + IntegerToString(Step1)
      + "&Step2=" + IntegerToString(Step2)
      + "&LinksChangingStep=" + IntegerToString(LinksChangingStep)
      + "&FixLot=" + boolToStr(FixLot)
      + "&Lot=" + DoubleToStr(Lot)
      + "&Y=" + DoubleToStr(Y)
      + "&K=" + DoubleToStr(K)
      + "&MaxTotalLots=" + DoubleToStr(MaxTotalLots)
      + "&Type_close=" + MaxTotalLots
      + "&n=" + DoubleToStr(n)
      + "&ActualTime=" + IntegerToString(ActualTime)
      + "&Magic1=" + IntegerToString(Magic1)
      + "&Magic2=" + IntegerToString(Magic2)
      ;
}

string makeSignature1(string salt)
{
   string signature = MD5((string)AccountNumber() + ":" +  secret1 + ":" +  salt + ":" + LicenceKey);
   StringToUpper(signature);
   return signature;
}

string makeSignature2(string salt)
{
   string signature = StringSubstr(MD5((string)AccountNumber() + ":" +  secret2 + ":" +  salt + ":" + LicenceKey), 0, 10);
   StringToUpper(signature);
   return signature;
}

string boolToStr(bool param)
{
   return (param) ? "true" : "false";
}


bool StrToBool(string param)
{
   if(
      param == "0" || 
      param == "-1" || 
      param == "false" || 
      param == "FALSE" || 
      param == "False" || 
      param == "" || 
      param == NULL
   ) {
      return false;
   } else {
      return true;
   }
}

void checkLicence()
{
   Print("Проверка лицензионного ключа...");   
   string salt = (string)AccountEquity();
   string params = "&eq=" + salt + "&signature=" + (string)makeSignature1(salt);
   string serverAnswer;

   serverAnswer = requestPOST("s.88855.ru", "licence.php?method=valid", compileParams(params));
   if(serverAnswer == "-1") {
      serverAnswer = requestPOST("mydoubletrend.com", "/system/valid", compileParams(params));
   }
   if(serverAnswer == "-1") {
      serverAnswer = requestPOST("135421.com", "/?method=valid", compileParams(params));
   }
   
   string signature2 = makeSignature2(salt);
   
   string licenceOk = "OK" + signature2;
   string licenceExpireClose = "EX" + signature2;
   string licenceExpireDemo = "DE" + signature2;
   string licenceNokey = "NOKEY";
   string licenceExpired = "EXPIRED";
   string licenceBad = "BAD";
   string licenceHardStop = "STOP" + signature2;
   
   string response = json(serverAnswer, "licence");
   
   if (response == licenceOk) {
   
      isHardStop = false;
      Print("Code 0: Лицензионный ключ активен"); 
      
   } else if (response == licenceExpireClose) {
   
      isHardStop = false;
      if(!expiryMessage) {
         Alert("Code 1: Срок действия лицензионного ключа подходит к концу");
         expiryMessage = true;
      }
      
   } else if (response == licenceExpireDemo) {
   
      isHardStop = false;
      if(!expiryMessage) {
         Alert("Code 50: Срок действия демо-ключа подходит к концу");
         expiryMessage = true;
      }
      
   } else if (response == licenceNokey) {
   
      licenceErrors++;
      isHardStop = false;
      FINISH = true;
      Alert("Code 2: Вы не зарегистрированы на сайте myDoubleTrend.com");
      
   } else if (response == licenceExpired) {
   
      licenceErrors++;
      isHardStop = false;
      FINISH = true;
      Alert("Code 3: Срок действия ключа истек. Продлите на сайте myDoubleTrend.com");
      
   } else if (response == licenceBad) {
   
      licenceErrors++;
      isHardStop = false;
      FINISH = true;
      Alert("Code -1: Ошибка проверки ключа. Свяжитесь с администрацией myDoubleTrend.com");
      
   } else if (response == licenceHardStop) {
   
      licenceErrors++;
      FINISH = true;
      isHardStop = true;
      MessageBox("Code 100: Робот не работает!");
      
   } else {
      
      licenceErrors++;
      FINISH = true;
      isHardStop = false;
      Alert("Code -1: Ошибка проверки ключа. Свяжитесь с администрацией myDoubleTrend.com");
      
   }
   
}

string json(string json, string key)
{
   JSONParser *parser = new JSONParser();
   JSONValue *jv = parser.parse(json);
   if (CheckPointer(jv) != POINTER_INVALID) {
      JSONObject *jo = jv;
      string result;
      if (jo.getString(key, result)) {
         delete jv;
         delete parser;
         return result;
      } else {
         delete jv;
         delete parser;
         return NULL;
      }
   } else {
      delete jv;
      delete parser;
      return NULL;
   }
   
}

void checkCanTrade()
{
   if(!IsTradeAllowed() && !tradeAllowMessage)  {
      Alert("Необходимо в настройках разрешить советнику торговать");
      tradeAllowMessage = true;
      ExpertRemove();
   }
   if(!IsDllsAllowed() && !dllMessage)
   {
      Alert("Необходимо в настройках разрешить импорт функций из DLL");
      dllMessage = true;
      ExpertRemove();
   }
}

bool isLicenceCheck()
{
   licenceCounter++;
   if (licenceCounter == licencePeriod) {
      licenceCounter = 0;
      return true;
   } else {
      return false;
   }
}

bool isParamsCheck()
{
   paramsCounter++;
   if (paramsCounter == paramsPeriod) {
      paramsCounter = 0;
      return true;
   } else {
      return false;
   }
}

bool isReinitCheck()
{
   reinitCounter++;
   if (reinitCounter == reinitPeriod) {
      reinitCounter = 0;
      return true;
   } else {
      return false;
   }
}

void setIntIfExists(string jsn, string key, int & var)
{
   string param = json(jsn, key);
   if(param != NULL) {
      var = (int)StrToInteger(param);
   }
}

void setBoolIfExists(string jsn, string key, bool & var)
{
   string param = json(jsn, key);
   if(param != NULL) {
      var = (bool)StrToBool(param);
   }
}

void setStringIfExists(string jsn, string key, string & var)
{
   string param = json(jsn, key);
   if(param != NULL) {
      var = (string)param;
   }
}

void setDoubleIfExists(string jsn, string key, double & var)
{
   string param = json(jsn, key);
   if(param != NULL) {
      var = (double)StrToDouble(param);
   }
}

void checkParams()
{
   Print("Получение параметров...");
   string salt = (string)AccountEquity();
   string params = "&eq=" + salt + "&signature=" + (string)makeSignature1(salt);
   string serverAnswer = requestPOST("s.88855.ru", "licence.php?method=get_params", compileParams(params));
   setBoolIfExists(serverAnswer, "FINISH", FINISH);
   setBoolIfExists(serverAnswer, "CUTTING_A", CUTTING_A);
   setBoolIfExists(serverAnswer, "CUTTING_B", CUTTING_B);
   setDoubleIfExists(serverAnswer, "q_A", q_A);
   setDoubleIfExists(serverAnswer, "q_B", q_B);
   setDoubleIfExists(serverAnswer, "N_A", N_A);
   setDoubleIfExists(serverAnswer, "N_B", N_B);
   setStringIfExists(serverAnswer, "I___Ticker", I___Ticker);
   setStringIfExists(serverAnswer, "I___Ticker", INST[0]);
   setStringIfExists(serverAnswer, "II__Ticker", II__Ticker);
   setStringIfExists(serverAnswer, "II__Ticker", INST[1]);
   setStringIfExists(serverAnswer, "Ind_TF", Ind_TF);
   setStringIfExists(serverAnswer, "Ind_Ticker", Ind_Ticker);
   setStringIfExists(serverAnswer, "Ind_Ticker", INST[2]);   
   setIntIfExists(serverAnswer, "MAPeriod", MAPeriod);
   setIntIfExists(serverAnswer, "MAType", MAType);
   setIntIfExists(serverAnswer, "Step1", Step1);
   setIntIfExists(serverAnswer, "Step2", Step2);
   setIntIfExists(serverAnswer, "LinksChangingStep", LinksChangingStep);
   setBoolIfExists(serverAnswer, "FixLot", FixLot);
   setDoubleIfExists(serverAnswer, "Lot", Lot);
   setDoubleIfExists(serverAnswer, "Y", Y);
   setDoubleIfExists(serverAnswer, "K", K);
   setDoubleIfExists(serverAnswer, "MaxTotalLots", MaxTotalLots);
   setStringIfExists(serverAnswer, "Type_close", Type_close);
   
   string typeClose = json(serverAnswer, "Type_close");
   if (typeClose != NULL)
   {
      if(typeClose == "progressive")
      {
         MOD = true;
      } else {
         MOD = false;
      }
   }
   
   setDoubleIfExists(serverAnswer, "n", n);
   setIntIfExists(serverAnswer, "ActualTime", ActualTime);
   setIntIfExists(serverAnswer, "ActualTime", Actl);
   setIntIfExists(serverAnswer, "Magic1", Magic1);
   setIntIfExists(serverAnswer, "Magic1", MAG[1]);
   setIntIfExists(serverAnswer, "Magic2", Magic2);
   setIntIfExists(serverAnswer, "Magic2", MAG[2]);
   
   Print("Code 10: Параметры получены");
   string reinit = json(serverAnswer, "REINIT");
   if (StrToBool(reinit)) {
      doReinit = true;
      Print("Запланирован автоматический перезапуск");
   }
   setIntIfExists(serverAnswer, "licenceErrors", licenceErrors);
}

void OnTimer () {
   if(DayOfWeek() != 0 && DayOfWeek() != 6) {
      go();
   }
   
   if (isLicenceCheck()) {
      checkLicence();
   }
   if (isParamsCheck()) {
      checkParams();
   }
   if (isReinitCheck()) {
      if(doReinit) {
         doReinit = false;
         Print("Перезапуск робота...");
         OnInit();
      }
   }
}

int countOrdersByMagic(int magic) 
{
   int count = 0;
   int index;
   for(index=OrdersTotal()-1;0<=index;index--) {  
      if(OrderSelect(index,SELECT_BY_POS)) {
         if(OrderMagicNumber() == magic) {
            count++;
         }
      }
   }
   return count;
}

//------------------------/SECURITY------------------------------------------------------

void OnInit()                        // ЗАПУСТИТЬ СЕАНС
{
   checkCanTrade();
   checkLicence();
   checkParams();
   EventSetTimer(1);
   int      m,x;
//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
   EV=EMPTY_VALUE-10;
   CHART=Symbol();   TFW=Period();
                     ITF=TFW;
   if(Ind_TF=="MN" ) ITF=PERIOD_MN1;
   if(Ind_TF=="W1" ) ITF=PERIOD_W1;
   if(Ind_TF=="D1" ) ITF=PERIOD_D1;
   if(Ind_TF=="H4" ) ITF=PERIOD_H4;
   if(Ind_TF=="H1" ) ITF=PERIOD_H1;
   if(Ind_TF=="M30") ITF=PERIOD_M30;
   if(Ind_TF=="M15") ITF=PERIOD_M15;
   if(Ind_TF=="M5" ) ITF=PERIOD_M5;
   if(Ind_TF=="M1" ) ITF=PERIOD_M1;
   LOG_FILE[0]="";
   LOG_FILE[1]=LOG_PREFIX+AccountNumber()+"_"+Magic1+".log";
   LOG_FILE[2]=LOG_PREFIX+AccountNumber()+"_"+Magic2+".log";
   LOG_FILE[3]="";
   WIN     [0]=0;
   WIN     [1]=Win1;
   WIN     [2]=Win2;
   WIN     [3]=0;
   ENB=true; EXST[0]=true; EXST[1]=true;
   TST=IsTesting();OPT=IsOptimization();//VIS=IsVisualMode();
   if(TST&&!TEST_LOG)OPT=true;
   PREFIXG=GBL_PREFIX; if(TST)PREFIXG="TEST_"+PREFIXG;
   INST[0]=I___Ticker; if(StringLen(INST[0])<=1)EXST[0]=false;
   INST[1]=II__Ticker; if(StringLen(INST[1])<=1)EXST[1]=false;
   INST[2]=Ind_Ticker;                          EXST[2]=true;
   if(!EXST[0]&&!EXST[1])
   {  ENB=false; Alert("At least ONE ticker must be determined");             return;
   }
   DATA();                                                           if(!ENB) return;
   if(EXST[0])POIN[0]=MarketInfo(INST[0],MODE_POINT );
   if(EXST[1])POIN[1]=MarketInfo(INST[1],MODE_POINT );
   if(EXST[0])DIGT[0]=MarketInfo(INST[0],MODE_DIGITS);
   if(EXST[1])DIGT[1]=MarketInfo(INST[1],MODE_DIGITS);
   if(0>q_A)DRSA=q_A; else DRSA=-q_A;
   if(0>q_B)DRSB=q_B; else DRSB=-q_B;
   TPR[1]=CPRF(1);
   MPR[1]=CPRF(1,PERIOD_MN1);
   WPR[1]=CPRF(1,PERIOD_W1);
   DPR[1]=CPRF(1,PERIOD_D1);
   TPR[2]=CPRF(2);
   MPR[2]=CPRF(2,PERIOD_MN1);
   WPR[2]=CPRF(2,PERIOD_W1);
   DPR[2]=CPRF(2,PERIOD_D1);
   MAG[0]=0;
   MAG[1]=Magic1;
   MAG[2]=Magic2;
   MAG[3]=0;
   for(m=0;m<=3;m++)
   {  SHFT [m]=PREFIXG+MAG[m]+"_shift";
      NBY0 [m]=PREFIXG+MAG[m]+"_Nbuy0";
      NSE0 [m]=PREFIXG+MAG[m]+"_Nsel0";
      NBY1 [m]=PREFIXG+MAG[m]+"_Nbuy1";
      NSE1 [m]=PREFIXG+MAG[m]+"_Nsel1";
      OVER [m]=PREFIXG+MAG[m]+"_Over";
      CMPL [m]=PREFIXG+MAG[m]+"_compl";
      PC[0][m]=PREFIXG+MAG[m]+"_part0";
      PC[1][m]=PREFIXG+MAG[m]+"_part1";
      PB[0][m]=PREFIXG+MAG[m]+"_parb0";
      PB[1][m]=PREFIXG+MAG[m]+"_parb1";
      PART [m]=PREFIXG+MAG[m]+"_PartC";
      CLSE [m]=PREFIXG+MAG[m]+"_Close";
      PRFC [m]=PREFIXG+MAG[m]+"_Cprof";
      PRFM [m]=PREFIXG+MAG[m]+"_Mprof";
      DRDN [m]=PREFIXG+MAG[m]+"_Drdwn";
      DRD0 [m]=PREFIXG+MAG[m]+"_Drdn0";
      NMAX [m]=PREFIXG+MAG[m]+"_NNmax";
      ITIM [m]=PREFIXG+MAG[m]+"_IndTm";
      IENB [m]=PREFIXG+MAG[m]+"_IndEn";
      DLOT [m]=PREFIXG+MAG[m]+"_Delay";
      for(x=0;x<=1;x++)
      {  OPE[x][m]=""; ERR[x][m]=""; CLO[x][m]="";
         PAR   [m]=""; PAS   [m]="";
   }  }
   CURR=TimeCurrent();
   WTIT(); REST(1,1); REST(2,1); Actl=ActualTime;
   Ty=StringSubstr(Type_close,0,2);
 //if(Ty=="st"||Ty=="ST"||Ty=="St")MOD=false;
   if(Ty=="pr"||Ty=="PR"||Ty=="Pr")MOD=true; else MOD=false;
   OPER[4]=" BUY-STOP  ";   OPER[5]="SELL-STOP  ";
   OPER[2]=" BUY-LIMIT ";   OPER[3]="SELL-LIMIT ";
   OPER[0]=" BUY       ";   OPER[1]="SELL       ";
   SaveD=iTime(NULL   ,PERIOD_D1,0);
   SaveM=iTime(NULL   ,PERIOD_M1,0);
   SaveW=0;
 //SaveT=iTime(NULL   ,TFW      ,0);
 //SaveW=iTime(INST[1],TFW      ,0);
                                                                              return;
}
//---------------------------------------------------------------------------------------
void OnDeinit(const int reason)                      // ЗАВЕРШИТЬ СЕАНС
{
//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
   if(TST)
   {  GlobalVariablesDeleteAll(PREFIXG);
                                                                              return;
   }
   Comment("");
                                                                              return;
}

void OnTick()
{
   go();
}

//---------------------------------------------------------------------------------------
int go()                       // ОБРАБОТАТЬ НОВЫЙ ТИК
{        string   mc;
         double   ma[4][4];
         bool     fl1=false,fl2=false;
         int      i,j;
//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
 //OpenM=iTime(NULL,PERIOD_M1,0);
 //if(SaveM!=OpenM)SaveM=OpenM;  else                                         return(0);
   if(!ENB)
   {  Comment("EXPERT DOESN\'T WORK !");
                                                                              return(0);
   }
 // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
            Save2= GlobalVariableGet(ITIM[2]);
            Save1= GlobalVariableGet(ITIM[1]);
            OpenT=iTime(Ind_Ticker,ITF,0);
  if(Save2!=OpenT)
  {  Save2 =OpenT; GlobalVariableSet(ITIM[2],Save2); fl2=true;
  }
  if(Save1!=OpenT)
  {  Save1 =OpenT; GlobalVariableSet(ITIM[1],Save1); fl1=true;
  }
  if(fl1||fl2)
  {for(j=1;j<=2;j++)for(i=0;i<=2;i++)
      ma[i][j]=iCustom(Ind_Ticker,ITF,IND,MAPeriod,MAType,i,j);
                  UP[2]=false;               UP[1]=false;
                  DN[2]=false;               DN[1]=false;
   if(ma[1][2]<EV)UP[2]=true; if(ma[1][1]<EV)UP[1]=true;
   if(ma[2][2]<EV)DN[2]=true; if(ma[2][1]<EV)DN[1]=true;
   if((UP[2]&&DN[1])||(DN[2]&&UP[1]))
   {  IEN=true;   if(fl2)GlobalVariableSet(IENB[2],IEN+0.1);
                  if(fl1)GlobalVariableSet(IENB[1],IEN+0.1);
   }else
   {  IEN=false;  if(fl2)GlobalVariableSet(IENB[2],IEN);
                  if(fl1)GlobalVariableSet(IENB[1],IEN);
  }}
 // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
   PROC(1); PROC(2);
   mc="Magic1="+MAG[1]+"   Magic2="+MAG[2];
   if(MOD)mc=mc+"   Type_close = PROGRESSIVE"+"  (n="+DoubleToStr(n,2)+")";
   else   mc=mc+"   Type_close = STANDARD   "+"  (n="+DoubleToStr(n,2)+")";
   if(IEN)mc=mc+"   INDICATOR ALLOWS\n";
   else   mc=mc+"   INDICATOR DOESN\'T ALLOW\n";
   Comment(mc,Comm[1],"\n",Comm[2]);
                                                                              return(0);
}
//---------------------------------------------------------------------------------------
string   FBOOL(bool v)                  // ПРЕОБРАЗОВАТЬ <TRUE-FALSE> В СТОКУ
{        string   r="";
//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
   if(v)r="TRUE"; else r="FALSE";
                                                                              return(r);
}
//---------------------------------------------------------------------------------------
string   FINT(int i)                   // ФОРМАТИРОВАТЬ ЦЕЛОЕ ЧИСЛО
{        string   v;
//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
   v=i;                 if(0<=i)v="+"+v;
   while(StringLen(v)< 8)v=" "+v;
                                                                              return(v);
}
//---------------------------------------------------------------------------------------
string   FINU(int i)                   // ФОРМАТИРОВАТЬ ЦЕЛОЕ ЧИСЛО
{        string   v;
//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
   v=i;                 if(0<=i)v=" "+v;
   while(StringLen(v)< 8)v=" "+v;
                                                                              return(v);
}
//---------------------------------------------------------------------------------------
string   FDBL(double p)                // ФОРМАТИРОВАТЬ ДРОБНОЕ ЧИСЛО
{        string   v;
//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
   v=DoubleToStr(p,2);  if(0<=p)v="+"+v;
   while(StringLen(v)<11)v=" "+v;
                                                                              return(v);
}
//---------------------------------------------------------------------------------------
string   FDBU(double p)                // ФОРМАТИРОВАТЬ ДРОБНОЕ ЧИСЛО
{        string   v;
//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
   v=DoubleToStr(p,2);  if(0<=p)v=" "+v;
   while(StringLen(v)<11)v=" "+v;
                                                                              return(v);
}
//---------------------------------------------------------------------------------------
void     DATA()                        // ЗАГРУЗИТЬ НЕОБХОДИМЫЕ БАРЫ ИСТОРИИ
{        int      b,m,k,e,tf;
         string   t,c,co;
//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
   co="";
   for(b=0;b<=2;b++)
   {  if(b==2)tf=ITF; else tf=TFW;
      if(!EXST[b])continue;
      for(m=1;m<=3;m++)
      {  t=TimeToStr(TimeCurrent(),TIME_DATE|TIME_MINUTES|TIME_SECONDS);
         c=t+" loading of history "+INST[b]+": attempt #"+m+"..."; co=co+"\n"+c;
         Comment(co); Print(c);
         RefreshRates();k=ArrayCopySeries(CHCK,MODE_TIME,INST[b],tf);
         e=GetLastError();if(e!=4066)break; Sleep(2500);
         t=TimeToStr(TimeCurrent(),TIME_DATE|TIME_MINUTES|TIME_SECONDS);
      }
      if(e!=4066)
      {  if(0<k)  {  c=t+INST[b]+" - loaded"       ; co=co+" - OK"      ;
                  }
         else     {  c=t+INST[b]+" - error #"+e+"!"; co=co+" - FAILURE!";
                     ENB=false; Alert("Tticker NOT found: "+INST[b]);
      }           }
      else
      {              c=t+INST[b]+" - error #"+e+"!"; co=co+" - FAILURE!";
                     ENB=false; Alert("Tticker NOT found: "+INST[b]);
      }
      Comment(co); Print(c); Sleep(500);
   }
   Sleep(2500); Comment("");
}
//---------------------------------------------------------------------------------------
void     REST(int p, int l=0)          // ЗАВЕРШИТЬ ЦИКЛ И НАЧАТЬ НОВЫЙ
{        string   oa,com;
         double   lp;
       //int      dy,hr,dd,j;
//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
   F_UP[p]=0; F_DN[p]=0; SCAN(p);
   dr[p]=GlobalVariableGet(DRDN[p]);
   d0[p]=GlobalVariableGet(DRD0[p]);
   lp   =GlobalVariableGet(PRFC[p]);
   TPR[p]=CPRF(p);
   MPR[p]=CPRF(p,PERIOD_MN1);
   WPR[p]=CPRF(p,PERIOD_W1);
   DPR[p]=CPRF(p,PERIOD_D1);
   if(TB[0]+TB[1]+TS[0]+TS[1]==0)
   {  if(l!=0)
      {  oa="C01_"+TimeToStr(CURR,TIME_DATE|TIME_MINUTES|TIME_SECONDS);
         ObjectCreate(oa,OBJ_VLINE,0,CURR,0);
         ObjectSet   (oa,OBJPROP_STYLE,STYLE_DASH);
         ObjectSet   (oa,OBJPROP_COLOR,WIN[p]);
         ObjectSet   (oa,OBJPROP_BACK,1);
         com=   "...........................................\r\n"
               +" PROFIT :"+" Last=   "+FDBL(lp    )      +"\r\n"
               +"         "+" Day=    "+FDBL(DPR[p])      +"\r\n"
               +"         "+" Week=   "+FDBL(WPR[p])      +"\r\n"
               +"         "+" Month=  "+FDBL(MPR[p])      +"\r\n"
               +"         "+" Entire= "+FDBL(TPR[p])      +"\r\n"
               +"...........................................\r\n"
               +"DRAWDOWN:"+" Last=   "+FDBL(d0 [p])      +"\r\n"
               +"         "+" Entire= "+FDBL(dr [p]);
         WLIN(com);
         WLIN("- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -");
         if(l==1&&5<=StringLen(SOUND))
         {  PlaySound(SOUND);
         }
         if(l==2&&5<=StringLen(FAIL ))
         {  PlaySound(FAIL);
         }
         SaveW=0;
      }
      if(EXST[0])Clos0[p]=iClose(INST[0],TFW,0)/POIN[0]+0.1; else Clos0[p]=0;
      if(EXST[1])Clos1[p]=iClose(INST[1],TFW,0)/POIN[1]+0.1; else Clos1[p]=0;
      pVertShift[p]=Clos0[p]-Clos1[p];
      pVertShift[p]=NormalizeDouble(pVertShift[p],0);
      GlobalVariableSet(SHFT [p],pVertShift[p]);
      GlobalVariableSet(NSE1 [p],0);
      GlobalVariableSet(NSE0 [p],0);
      GlobalVariableSet(NBY0 [p],0);
      GlobalVariableSet(NBY1 [p],0);
      GlobalVariableSet(CLSE [p],0);
      GlobalVariableSet(OVER [p],0);
      GlobalVariableSet(DRD0 [p],0);
      GlobalVariableSet(CMPL [p],0);
      GlobalVariableSet(PART [p],0);
      GlobalVariableSet(ITIM [p],0);
      GlobalVariableSet(IENB [p],0);
      GlobalVariableSet(DLOT [p],0);
      GlobalVariableSet(PC[0][p],0);
      GlobalVariableSet(PC[1][p],0);
      GlobalVariableSet(PB[0][p],0);
      GlobalVariableSet(PB[1][p],0);
      OPE[0][p]="";ERR[0][p]="";
      OPE[1][p]="";ERR[1][p]="";
}  }
//---------------------------------------------------------------------------------------
void     SCAN(int r)                   // СОСТАВИТЬ СПИСОК ОРДЕРОВ СОВЕТНИКА
{        int      a,k,i,t,m;
         double   p,l,z;
         string   s;
         datetime e;
//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
   a=3-r;
   TS  [0]=0; TS  [1]=0;
   TB  [0]=0; TB  [1]=0;
   TotL[0]=0; TotL[1]=0;
   TLM [0]=0; TLM [1]=0;
   TotProf[r]=0;
   for(k=OrdersTotal()-1;0<=k;k--)
   {  if(!OrderSelect(k,SELECT_BY_POS))                     continue;
      t=OrderType();m=OrderMagicNumber();s=OrderSymbol();
      if((s!=INST[0]&&s!=INST[1])||2<=t)                    continue;
      if(m==MAG[a])
      {  l=OrderLots();
         if(s==INST[0])
         {  if(t==OP_BUY )TLM[0]+=l;
            if(t==OP_SELL)TLM[0]-=l;
         }
         if(s==INST[1])
         {  if(t==OP_BUY )TLM[1]+=l;
            if(t==OP_SELL)TLM[1]-=l;
         }
                                                            continue;
      }
      if(m!=MAG[r])                                         continue;
      if(s==INST[0])m=0; if(s==INST[1])m=1;
      z=OrderProfit()+OrderSwap()+OrderCommission(); TotProf[r]+=z;
      i=OrderTicket(); p=OrderOpenPrice(); e=OrderOpenTime();
      l=OrderLots();
      if(t==OP_BUY )
      {     B[m][TB[m]]=i; OpnB[m][TB[m]]=p; TimB[m][TB[m]]=e;
         LotB[m][TB[m]]=l; TotL[m]+=l;       PrfB[m][TB[m]]=z;
                 TB[m]++;
      }
      if(t==OP_SELL)
      {     S[m][TS[m]]=i; OpnS[m][TS[m]]=p; TimS[m][TS[m]]=e;
         LotS[m][TS[m]]=l; TotL[m]+=l;       PrfS[m][TS[m]]=z;
                 TS[m]++;
   }  }
   TotPerc[r]=100.0*TotProf[r]/AccountBalance();
}
//---------------------------------------------------------------------------------------
bool     CHCK(int p)                   // ПРОВЕРИТЬ СООТВЕТСТВИЕ ЛОТОВ
{        bool     r=true;
         int      j,k;
//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
//if(TB[0]==NB[0]&&TS[1]==NS[1]&&TS[0]==NS[0]&&TB[1]==NB[1])
   if(!EXST[0]||!EXST[1])                                                     return(r);
   if(0<TB[0]&&0<TS[1]&&0==TS[0]&&0==TB[1])
   {  for(j=0;j<TS[1];j++)MTRX[1][j]= -1;
      for(k=0;k<TB[0];k++)MTRX[0][k]= -1;
      for(j=0;j<TS[1];j++)
      for(k=0;k<TB[0];k++)
      {  if(NormalizeDouble(LotB[0][k],2)==NormalizeDouble(LotS[1][j],2))
         {  MTRX[1][j]= k;
            MTRX[0][k]= j;
      }  }
      for(j=0;j<TS[1];j++)if(MTRX[1][j]<0){r=false;break;}
      for(k=0;k<TB[0];k++)if(MTRX[0][k]<0){r=false;break;}
   }
   if(0<TS[0]&&0<TB[1]&&0==TB[0]&&0==TS[1])
   {  for(j=0;j<TB[1];j++)MTRX[1][j]= -1;
      for(k=0;k<TS[0];k++)MTRX[0][k]= -1;
      for(j=0;j<TB[1];j++)
      for(k=0;k<TS[0];k++)
      {  if(NormalizeDouble(LotS[0][k],2)==NormalizeDouble(LotB[1][j],2))
         {  MTRX[1][j]= k;
            MTRX[0][k]= j;
      }  }
      for(j=0;j<TB[1];j++)if(MTRX[1][j]<0){r=false;break;}
      for(k=0;k<TS[0];k++)if(MTRX[0][k]<0){r=false;break;}
   }
                                                                              return(r);
}
//---------------------------------------------------------------------------------------
bool     CORR(int p)                   // ЗАКРЫТЬ  НЕСООТВЕТСТВУЮЩИЕ ЛОТЫ
{        int      j,k,CDigits;
         bool     m,r=true;
         double   CAsk,CBid,CPoint;//PR;
         string   opr,cur,tm,com,mes[2];
//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
//if(TB[0]==NB[0]&&TS[1]==NS[1]&&TS[0]==NS[0]&&TB[1]==NB[1])
   if(!EXST[0]||!EXST[1])                                                     return(r);
        mes[0]="";mes[1]="";
   if(0< TB[0]&&0< TS[1]&&0==TS[0]&&0==TB[1])
   {  cur=INST[1];
      for(j=0;j< TS[1];j++)
      {  if(0<=MTRX[1][j])continue;
         opr="("+p+") "+OPER[OP_SELL]+cur+" "+DoubleToStr(LotS[1][j],2);
         tm=TimeToStr(TimeCurrent(),TIME_DATE|TIME_MINUTES|TIME_SECONDS)+" ";
         com=tm+mes[0]+mes[1]+" waiting for closure of "+opr+" ..."; Comment(com);
         WFTC(); CAsk=MarketInfo(cur,MODE_ASK); CDigits=MarketInfo(cur,MODE_DIGITS);
         CPoint=MarketInfo(cur,MODE_POINT);  SLIP=0.0001*SlipPP*CAsk/CPoint;
         opr=opr+" @ "+DoubleToStr(CAsk,CDigits);
         m=OrderClose(S[1][j],LotS[1][j],CAsk,2*SLIP); r=r&&m;
         tm=TimeToStr(TimeCurrent(),TIME_DATE|TIME_MINUTES|TIME_SECONDS)+" ";
         mes[1]=mes[1]+tm;
         if(m)
         {     mes[1]=mes[1]+opr+" - closed by <CORR>\r\n";
         }
         else  mes[1]=mes[1]+opr+" - NOT closed by <CORR> - FAILURE #"
                                +GetLastError()+"\r\n";
         Comment(mes[0]+mes[1]);
      }
      cur=INST[0];
      for(k=0;k< TB[0];k++)
      {  if(0<=MTRX[0][k])continue;
         opr="("+p+") "+OPER[OP_BUY ]+cur+" "+DoubleToStr(LotB[0][k],2);
         tm=TimeToStr(TimeCurrent(),TIME_DATE|TIME_MINUTES|TIME_SECONDS)+" ";
         com=tm+mes[0]+mes[1]+" waiting for closure of "+opr+" ..."; Comment(com);
         WFTC(); CBid=MarketInfo(cur,MODE_BID); CDigits=MarketInfo(cur,MODE_DIGITS);
         CPoint=MarketInfo(cur,MODE_POINT);  SLIP=0.0001*SlipPP*CBid/CPoint;
         opr=opr+" @ "+DoubleToStr(CBid,CDigits);
         m=OrderClose(B[0][k],LotB[0][k],CBid,2*SLIP); r=r&&m;
         tm=TimeToStr(TimeCurrent(),TIME_DATE|TIME_MINUTES|TIME_SECONDS)+" ";
         mes[0]=mes[0]+tm;
         if(m)
         {     mes[0]=mes[0]+opr+" - closed by <CORR>\r\n";
         }
         else  mes[0]=mes[0]+opr+" - NOT closed by <CORR> - FAILURE #"
                                +GetLastError()+"\r\n";
         Comment(mes[0]+mes[1]);
   }  }
   if(0<TS[0]&&0<TB[1]&&0==TB[0]&&0==TS[1])
   {  cur=INST[1];
      for(j=0;j<TB[1];j++)
      {  if(0<=MTRX[1][j])continue;
         opr="("+p+") "+OPER[OP_BUY ]+cur+" "+DoubleToStr(LotB[1][j],2);
         tm=TimeToStr(TimeCurrent(),TIME_DATE|TIME_MINUTES|TIME_SECONDS)+" ";
         com=tm+mes[0]+mes[1]+" waiting for closure of "+opr+" ..."; Comment(com);
         WFTC(); CBid=MarketInfo(cur,MODE_BID); CDigits=MarketInfo(cur,MODE_DIGITS);
         CPoint=MarketInfo(cur,MODE_POINT);  SLIP=0.0001*SlipPP*CBid/CPoint;
         opr=opr+" @ "+DoubleToStr(CBid,CDigits);
         m=OrderClose(B[1][j],LotB[1][j],CBid,2*SLIP); r=r&&m;
         tm=TimeToStr(TimeCurrent(),TIME_DATE|TIME_MINUTES|TIME_SECONDS)+" ";
         mes[1]=mes[1]+tm;
         if(m)
         {     mes[1]=mes[1]+opr+" - closed by <CORR>\r\n";
         }
         else  mes[1]=mes[1]+opr+" - NOT closed by <CORR> - FAILURE #"
                                +GetLastError()+"\r\n";
         Comment(mes[0]+mes[1]);
      }
      cur=INST[0];
      for(k=0;k<TS[0];k++)
      {  if(0<=MTRX[0][k])continue;
         opr="("+p+") "+OPER[OP_SELL]+cur+" "+DoubleToStr(LotS[0][k],2);
         tm=TimeToStr(TimeCurrent(),TIME_DATE|TIME_MINUTES|TIME_SECONDS)+" ";
         com=tm+mes[0]+mes[1]+" waiting for closure of "+opr+" ..."; Comment(com);
         WFTC(); CAsk=MarketInfo(cur,MODE_ASK); CDigits=MarketInfo(cur,MODE_DIGITS);
         CPoint=MarketInfo(cur,MODE_POINT);  SLIP=0.0001*SlipPP*CAsk/CPoint;
         opr=opr+" @ "+DoubleToStr(CAsk,CDigits);
         m=OrderClose(S[0][k],LotS[0][k],CAsk,2*SLIP); r=r&&m;
         tm=TimeToStr(TimeCurrent(),TIME_DATE|TIME_MINUTES|TIME_SECONDS)+" ";
         mes[0]=mes[0]+tm;
         if(m)
         {     mes[0]=mes[0]+opr+" - closed by <CORR>\r\n";
         }
         else  mes[0]=mes[0]+opr+" - NOT closed by <CORR> - FAILURE #"
                                +GetLastError()+"\r\n";
         Comment(mes[0]+mes[1]);
   }  }
   WLIN(mes[0],0); CLO[0][p]=mes[0];
   WLIN(mes[1],0); CLO[1][p]=mes[1];
 //
   SCAN(p);NB[0]=TB[0];NS[1]=TS[1];NS[0]=TS[0];NB[1]=TB[1];
   GlobalVariableSet(NBY0[p],NB[0]);
   GlobalVariableSet(NSE1[p],NS[1]);
   GlobalVariableSet(NSE0[p],NS[0]);
   GlobalVariableSet(NBY1[p],NB[1]);
                                                                             return(r);
}
//---------------------------------------------------------------------------------------
int      PROC(int p)                   // ОБРАБОТАТЬ ПРОЦЕСС
{        string   tm,oa,inf;
         double   LOTS,pm,prt;
       //color    CO;
         bool     nc;
         int      lst0,lst1,ref0,ref1,clo0,clo1,cur0,cur1,lstd,curd,k;
//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
   SCAN(p); CURR=TimeCurrent();  Step=0;
        if(TB[1]<TB[0])TBM=TB[0]; else TBM=TB[1];
        if(TS[1]<TS[0])TSM=TS[0]; else TSM=TS[1];
        if(TSM  <TBM  )TMM=TBM;   else TMM=TSM;
   if(NEM+60<=CURR)NEM=0;              // снять запрет на открытие ордеров
      pm=                        GlobalVariableGet(PRFM[p]);
      nn[p]=                     GlobalVariableGet(NMAX[p])+0.1;
   if(nn[p]<TB[0]+TS[0])
   {  nn[p]=TB[0]+TS[0];         GlobalVariableSet(NMAX[p],nn[p]);
   }
   if(nn[p]<TB[1]+TS[1])
   {  nn[p]=TB[1]+TS[1];         GlobalVariableSet(NMAX[p],nn[p]);
   }
                     dr[p]=      GlobalVariableGet(DRDN[p]);
                     d0[p]=      GlobalVariableGet(DRD0[p]);
   if(pm   <TPR[p]+TotProf[p])
   {  pm   =TPR[p]+TotProf[p];   GlobalVariableSet(PRFM[p],pm);
   }
   if(dr[p]>TPR[p]+TotProf[p]-pm)
   {  dr[p]=TPR[p]+TotProf[p]-pm;GlobalVariableSet(DRDN[p],dr[p]);
   }
   if(d0[p]>TPR[p]+TotProf[p]-pm)
   {  d0[p]=TPR[p]+TotProf[p]-pm;GlobalVariableSet(DRD0[p],d0[p]);
   }
         if(EXST[0])Clos0[p]=iClose(INST[0],TFW,0)/POIN[0]+0.1; else Clos0[p]=0;
         if(EXST[1])Clos1[p]=iClose(INST[1],TFW,0)/POIN[1]+0.1; else Clos1[p]=0;
   pVertShift[p]=                GlobalVariableGet(SHFT[p])+0.1;
   DF[p]=Clos1[p]+pVertShift[p]-Clos0[p];
   NB[0]=                        GlobalVariableGet(NBY0[p])+0.1;
   NS[1]=                        GlobalVariableGet(NSE1[p])+0.1;
   NS[0]=                        GlobalVariableGet(NSE0[p])+0.1;
   NB[1]=                        GlobalVariableGet(NBY1[p])+0.1;
   if(FixLot)LOTS=Lot; else LOTS=(AccountEquity()/Y)*0.1;
         STLT[0][p]=LOTS;
         STLT[1][p]=LOTS;
//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
   nc=GlobalVariableGet(CMPL[p]);if(nc)// не все ордера закрыты по норме полной прибыли
   {  ce[p]=CLOS(p);if(ce[p])          // закрыть всё
      {  REST(p,1);                    // сбросить схему
                                                                              return(0);
   }  }
//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
                                       // проверить просадку и включить CUTTING
   PRT[p]=     GlobalVariableGet(PART[p]);
   if(DRSB<=DRSA)
   {  if(CUTTING_B&&DRSB>=TotPerc[p]&&PRT[p]!=2)
      {        GlobalVariableSet(PART[p],2.1);//PAS[p]="";
      }else
      if(CUTTING_A&&DRSA>=TotPerc[p]&&PRT[p]==0)
      {        GlobalVariableSet(PART[p],1.1);//PAS[p]="";
   }  }
   else//if(DRSA<DRSB)
   {  if(CUTTING_A&&DRSA>=TotPerc[p]&&PRT[p]!=1)
      {        GlobalVariableSet(PART[p],1.1);//PAS[p]="";
      }else
      if(CUTTING_B&&DRSB>=TotPerc[p]&&PRT[p]==0)
      {        GlobalVariableSet(PART[p],2.1);//PAS[p]="";
   }  }
   PRT[p]=     GlobalVariableGet(PART[p]);
//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
  if((F_UP[p]==0&&F_DN[p]==0)||0.5<GlobalVariableGet(OVER[p]))
  {//if(TB[0]==NB[0]&&TS[1]==NS[1]&&TS[0]==NS[0]&&TB[1]==NB[1])
   if(CHCK(p))                         // лоты корректны
   {if(0<TB[0]+TS[1]+TS[0]+TB[1])      // есть открытые позиции
    {            STLT[0][p] =0;
      if(0<TB[0])STLT[0][p]+=LotB[0][TB[0]-1];
      if(0<TS[0])STLT[0][p]+=LotS[0][TS[0]-1];
                 STLT[1][p] =0;
      if(0<TB[1])STLT[1][p]+=LotB[1][TB[1]-1];
      if(0<TS[1])STLT[1][p]+=LotS[1][TS[1]-1];
      // -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -
      // проверка возможности полного закрытия (всегда)
      //
      if(MOD)REQP[p] =(TotL[0]   +TotL[1]   )*n;
      else   REQP[p] =(STLT[0][p]+STLT[1][p])*n;
      if(    REQP[p]<=TotProf[p])      // выполнена норма прибыли
      {  inf="ENTIRE profit is closed ";
         GlobalVariableSet(CMPL[p],1.1);
         if(ce[p])
         {  CLO[0][p]=""; CLO[1][p]="";
         }
         ce[p]=CLOS(p);                // закрыть всё
         prt=GlobalVariableGet(PRFC[p]);
         inf=inf+FDBL(prt);
         PAS[p]=TimeToStr(CURR,TIME_DATE|TIME_MINUTES|TIME_SECONDS)+"  "+inf;
         Print(inf);WLIN(inf);
         if(ce[p])
         {  REST(p,1);                 // сбросить схему
                                                                              return(0);
      }  }
      // -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -
      // проверка возможности частичного закрытия
      //
      if(1==PRT[p])                    // режим частичного закрытия <A>
      { PAR[p]="";
                   ClosLot =0;
        if(0<TB[0])ClosLot+=LotB[0][TB[0]-1];
        if(0<TS[0])ClosLot+=LotS[0][TS[0]-1];
        if(0<TB[1])ClosLot+=LotB[1][TB[1]-1];
        if(0<TS[1])ClosLot+=LotS[1][TS[1]-1];
                   ClosPrf =0;
        if(0<TB[0])ClosPrf+=PrfB[0][TB[0]-1];
        if(0<TS[0])ClosPrf+=PrfS[0][TS[0]-1];
        if(0<TB[1])ClosPrf+=PrfB[1][TB[1]-1];
        if(0<TS[1])ClosPrf+=PrfS[1][TS[1]-1];
        for(k=0;k<TMM;k++)
        {            LinkPrf[k] =0;
          if(k<TB[0])LinkPrf[k]+=PrfB[0][k];
          if(k<TS[0])LinkPrf[k]+=PrfS[0][k];
          if(k<TB[1])LinkPrf[k]+=PrfB[1][k];
          if(k<TS[1])LinkPrf[k]+=PrfS[1][k];
          //PAR=PAR+k+"  $"+DoubleToStr(LinkPrf[k],2)+"\n";
          if(      0<LinkPrf[k])
         {           LinkLot[k] =0;
          if(k<TB[0])LinkLot[k]+=LotB[0][k];
          if(k<TS[0])LinkLot[k]+=LotS[0][k];
          if(k<TB[1])LinkLot[k]+=LotB[1][k];
          if(k<TS[1])LinkLot[k]+=LotS[1][k];
          ClosLot+=  LinkLot[k];
          ClosPrf+=  LinkPrf[k];
        }} REQP[p] =N_A*ClosLot;
          //PAR="ClosLot="+DoubleToStr(ClosLot,2)
          //   +"  ClosPrf="+DoubleToStr(ClosPrf,2)+"\n"+PAR;
        if(REQP[p]<=    ClosPrf)
        { //PAS="ClosLot="+DoubleToStr(ClosLot,2)
          //   +"  ClosPrf="+DoubleToStr(ClosPrf,2)+"\n"+PAR;
         inf="Partial profit <A> is closed ";
         ca[p]=CUTA(p);                // Закрыть блок (первое звено и прибыльные звенья)
         prt=GlobalVariableGet(PRFC[p]);
         inf=inf+FDBL(prt);
         PAS[p]=TimeToStr(CURR,TIME_DATE|TIME_MINUTES|TIME_SECONDS)+"  "+inf;
         Print(inf);WLIN(inf);
         GlobalVariableSet(PART[p],0  );
         GlobalVariableSet(DLOT[p],1.1);
         SCAN(p);
         if(TB[0]+TS[1]+TS[0]+TB[1]==0)// нет позиций
         {  REST(p,1);                 // сбросить схему
         }else
         { if(!ca[p])
            {  cs[p]=CHCK(p); if(!cs[p])cs[p]=CORR(p);
            }
            NB[0]=TB[0];NS[1]=TS[1];NS[0]=TS[0];NB[1]=TB[1];
            GlobalVariableSet(NBY0[p],NB[0]);
            GlobalVariableSet(NSE1[p],NS[1]);
            GlobalVariableSet(NSE0[p],NS[0]);
            GlobalVariableSet(NBY1[p],NB[1]);
         }
                                                                              return(0);
      } }
      if(2==PRT[p])                    // режим частичного закрытия <B>
      { PAR[p]="";
                   ClosLot =0;
        for(k=0;k<TB[0]&&k<=1;k++)ClosLot+=LotB[0][k];
        for(k=0;k<TS[0]&&k<=1;k++)ClosLot+=LotS[0][k];
        for(k=0;k<TB[1]&&k<=1;k++)ClosLot+=LotB[1][k];
        for(k=0;k<TS[1]&&k<=1;k++)ClosLot+=LotS[1][k];
                   ClosPrf =0;
        for(k=0;k<TB[0]&&k<=1;k++)ClosPrf+=PrfB[0][k];
        for(k=0;k<TS[0]&&k<=1;k++)ClosPrf+=PrfS[0][k];
        for(k=0;k<TB[1]&&k<=1;k++)ClosPrf+=PrfB[1][k];
        for(k=0;k<TS[1]&&k<=1;k++)ClosPrf+=PrfS[1][k];
           REQP[p] =N_B*ClosLot;
          //PAR="ClosLot="+DoubleToStr(ClosLot,2)
          //   +"  ClosPrf="+DoubleToStr(ClosPrf,2)+"\n"+PAR;
        if(REQP[p]<=    ClosPrf)
        { //PAS="ClosLot="+DoubleToStr(ClosLot,2)
          //   +"  ClosPrf="+DoubleToStr(ClosPrf,2)+"\n"+PAR;
         inf="Partial profit <B> is closed ";
         cb[p]=CUTB(p);                // Закрыть блок (два последних звена)
         prt=GlobalVariableGet(PRFC[p]);
         inf=inf+FDBL(prt);
         PAS[p]=TimeToStr(CURR,TIME_DATE|TIME_MINUTES|TIME_SECONDS)+"  "+inf;
         Print(inf);WLIN(inf);
         GlobalVariableSet(PART[p],0  );
       //GlobalVariableSet(DLOT[p],1.1);
         SCAN(p);
         if(TB[0]+TS[1]+TS[0]+TB[1]==0)// нет позиций
         {  REST(p,1);                 // сбросить схему
         }else
         { if(!cb[p])
            {  cs[p]=CHCK(p); if(!cs[p])cs[p]=CORR(p);
            }
            NB[0]=TB[0];NS[1]=TS[1];NS[0]=TS[0];NB[1]=TB[1];
            GlobalVariableSet(NBY0[p],NB[0]);
            GlobalVariableSet(NSE1[p],NS[1]);
            GlobalVariableSet(NSE0[p],NS[0]);
            GlobalVariableSet(NBY1[p],NB[1]);
         }
                                                                              return(0);
   }} } }
   else                                // перекос лотов
   {  inf="####### Asymmetrical Lots! #######";
      cs[p]=CORR(p);                   // закрыть непарные лоты
      WLIN(inf);Print(inf);Alert(inf);
      if(5<=StringLen(FAIL))PlaySound(FAIL);
                                                                              return(0);
  }}
//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
   if(0<F_UP[p]&&F_UP[p]+Actl<CURR)    // истекло время актуальности сделок
   {  inf="";
      if(0<StringLen(ERR[0][p]))
      {inf=ERR[0][p]+" - Transaction isn\'t actual";// ("
               //   +TimeToStr(TimeCurrent(),TIME_DATE|TIME_MINUTES|TIME_SECONDS)+")";
       WLIN(inf);Print(inf);
      }
      if(0<StringLen(ERR[1][p]))
      {inf=ERR[1][p]+" - Transaction isn\'t actual";// ("
               //   +TimeToStr(TimeCurrent(),TIME_DATE|TIME_MINUTES|TIME_SECONDS)+")";
       WLIN(inf);Print(inf);
      }
      if(5<=StringLen(FAIL))PlaySound(FAIL);
      cs[p]=CHCK(p); if(!cs[p])cs[p]=CORR(p); if(cs[p])F_UP[p]=0;
                                                                              return(0);
   }
   if(0<F_DN[p]&&F_DN[p]+Actl<CURR)    // истекло время актуальности сделок
   {  inf="";
      if(0<StringLen(ERR[0][p]))
      {inf=ERR[0][p]+" - Transaction isn\'t actual";// ("
               //   +TimeToStr(TimeCurrent(),TIME_DATE|TIME_MINUTES|TIME_SECONDS)+")";
       WLIN(inf);Print(inf);
      }
      if(0<StringLen(ERR[1][p]))
      {inf=ERR[1][p]+" - Transaction isn\'t actual";// ("
               //   +TimeToStr(TimeCurrent(),TIME_DATE|TIME_MINUTES|TIME_SECONDS)+")";
       WLIN(inf);Print(inf);
      }
      if(5<=StringLen(FAIL))PlaySound(FAIL);
      cs[p]=CHCK(p); if(!cs[p])cs[p]=CORR(p); if(cs[p])F_DN[p]=0;
                                                                              return(0);
   }
//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
   if(TB[0]+TS[1]+TS[0]+TB[1]==0)      // нет позиций
   {  REQP[p]=0; LSTD[p]=0;
      if(F_UP[p]==0&&F_DN[p]==0&& 0.000001>TLM[0]&&-0.000001<TLM[1]&&!FINISH)
      {  F_UP[p]=CURR;                 // 1-й BUY/SELL
      }
      if(F_DN[p]==0&&F_UP[p]==0&&-0.000001<TLM[0]&& 0.000001>TLM[1]&&!FINISH)
      {  F_DN[p]=CURR;                 // 1-й SELL/BUY
   }  }
   if(F_UP[p]==0&&0<TB[0]+TS[1]&&TS[0]+TB[1]==0)
   {  IE=GlobalVariableGet(IENB[p]);
      if(LinksChangingStep>TMM)
      {  Step=Step1; SEN=true;
      }else
      {  Step=Step2; SEN=false;
      }
      if(EXST[0])ref0=GlobalVariableGet(PC[0][p]) /POIN[0]+0.1; else ref0=0;
      if(EXST[1])ref1=GlobalVariableGet(PC[1][p]) /POIN[1]+0.1; else ref1=0;
      if(EXST[0])clo0=GlobalVariableGet(PB[0][p]) /POIN[0]+0.1; else clo0=0;
      if(EXST[1])clo1=GlobalVariableGet(PB[1][p]) /POIN[1]+0.1; else clo1=0;
      if(0<TB[0])lst0=OpnB[0][0]                  /POIN[0]+0.1; else lst0=0;
      if(0<TS[1])lst1=OpnS[1][0]                  /POIN[1]+0.1; else lst1=0;
      if(EXST[0])cur0=MarketInfo(INST[0],MODE_ASK)/POIN[0]+0.1; else cur0=0;
      if(EXST[1])cur1=MarketInfo(INST[1],MODE_BID)/POIN[1]+0.1; else cur1=0;
      if(0<ref0)lst0=ref0;
      if(0<ref1)lst1=ref1;
      lstd=lst1-lst0; curd=cur1-cur0; LSTD[p]=lstd-curd;
      if(  (0<clo0+clo1)
         ||(lstd+Step<=curd&&(SEN||IE))   )
      {  F_UP[p]=CURR;                 // N-й BUY/SELL
   }  }
   if(F_DN[p]==0&&TB[0]+TS[1]==0&&0<TS[0]+TB[1])
   {  IE=GlobalVariableGet(IENB[p]);
      if(LinksChangingStep>TMM)
      {  Step=Step1; SEN=true;
      }else
      {  Step=Step2; SEN=false;
      }
      if(EXST[0])ref0=GlobalVariableGet(PC[0][p]) /POIN[0]+0.1; else ref0=0;
      if(EXST[1])ref1=GlobalVariableGet(PC[1][p]) /POIN[1]+0.1; else ref1=0;
      if(EXST[0])clo0=GlobalVariableGet(PB[0][p]) /POIN[0]+0.1; else clo0=0;
      if(EXST[1])clo1=GlobalVariableGet(PB[1][p]) /POIN[1]+0.1; else clo1=0;
      if(0<TS[0])lst0=OpnS[0][0]                  /POIN[0]+0.1; else lst0=0;
      if(0<TB[1])lst1=OpnB[1][0]                  /POIN[1]+0.1; else lst1=0;
      if(EXST[0])cur0=MarketInfo(INST[0],MODE_BID)/POIN[0]+0.1; else cur0=0;
      if(EXST[1])cur1=MarketInfo(INST[1],MODE_ASK)/POIN[1]+0.1; else cur1=0;
      if(0<ref0)lst0=ref0;
      if(0<ref1)lst1=ref1;
      lstd=lst0-lst1; curd=cur0-cur1; LSTD[p]=lstd-curd;
      if(  (0<clo0+clo1)
         ||(lstd+Step<=curd&&(SEN||IE))   )
      {  F_DN[p]=CURR;                 // N-й SELL/BUY
   }  }
//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
   if(0<F_UP[p]&&CURR<F_UP[p]+Actl)    // сделки актуальны
   {//NB[0]=GlobalVariableGet(NBY0[p])+0.1;
    //NS[1]=GlobalVariableGet(NSE1[p])+0.1;
      DLT=  GlobalVariableGet(DLOT[p]); if(DLT)KL=1.0; else KL=K;
      o[0][p]=true; o[1][p]=true;
      if(EXST[0]&&TB[0]==NB[0])        // позиция ещё не открыта
      {  if(0<TB[0])LOTS=KL*LotB[0][0];
         tm=TimeToStr(TimeCurrent(),TIME_DATE|TIME_MINUTES|TIME_SECONDS)+" ";
         if(AccountFreeMarginCheck(INST[0],OP_BUY ,2*LOTS)<0)
         {o[0][p]=false;
          ERR[0][p]=tm+"("+p+") "+OPER[0]+INST[0]+" "+DoubleToStr(LOTS,2)
                                 +" - NOT enough money!";
          if(NEM==0)NEM=TimeCurrent(); // установить запрет на 60 секунд
         }
         else o[0][p]=OBUY(0,p,LOTS);if(o[0][p])
         {  /*
            oa="O0_"+TimeToStr(CURR,TIME_DATE|TIME_MINUTES|TIME_SECONDS);
            ObjectCreate(oa,OBJ_ARROW,0,CURR,ASK[0]);
            ObjectSet   (oa,OBJPROP_ARROWCODE,1);
            ObjectSet   (oa,OBJPROP_COLOR,Buy);
            ObjectSet   (oa,OBJPROP_BACK,0);
            */
      }  }
      if(EXST[1]&&TS[1]==NS[1])        // позиция ещё не открыта
      {  if(0<TS[1])LOTS=KL*LotS[1][0];
         tm=TimeToStr(TimeCurrent(),TIME_DATE|TIME_MINUTES|TIME_SECONDS)+" ";
         if(  ( o[0][p]&&AccountFreeMarginCheck(INST[1],OP_SELL,  LOTS)<0)
            ||(!o[0][p]&&AccountFreeMarginCheck(INST[1],OP_SELL,2*LOTS)<0) )
         {o[1][p]=false;
          ERR[1][p]=tm+"("+p+") "+OPER[1]+INST[1]+" "+DoubleToStr(LOTS,2)
                                 +" - NOT enough money!";
          if(NEM==0)NEM=TimeCurrent(); // установить запрет на 60 секунд
         }
         else o[1][p]=OSEL(1,p,LOTS);if(o[1][p])
         {  /*
            CL[0]=MarketInfo(INST[1],MODE_BID)/POIN[1]+pVertShift+0.1;
            cl=NormalizeDouble(CL[0]*POIN[0],DIGT[0]);
            oa="O1_"+TimeToStr(CURR,TIME_DATE|TIME_MINUTES|TIME_SECONDS);
            ObjectCreate(oa,OBJ_ARROW,0,CURR,cl);
            ObjectSet   (oa,OBJPROP_ARROWCODE,1);
            ObjectSet   (oa,OBJPROP_COLOR,Sel);
            ObjectSet   (oa,OBJPROP_BACK,0);
            */
      }  }
      if(o[0][p]&&o[1][p])
      {  F_UP[p]=0;                    // портфель заполнен
         if(EXST[0])NB[0]++;
         if(EXST[1])NS[1]++;
         GlobalVariableSet(NBY0 [p],NB[0]);
         GlobalVariableSet(NSE1 [p],NS[1]);
         GlobalVariableSet(IENB [p], 0   );
         GlobalVariableSet(DLOT [p], 0   );
         GlobalVariableSet(PC[0][p], 0   );
         GlobalVariableSet(PC[1][p], 0   );
         GlobalVariableSet(PB[0][p], 0   );
         GlobalVariableSet(PB[1][p], 0   );
       //CLO[0][p]=""; CLO[1][p]="";
         if(5<=StringLen(OPEN))PlaySound(OPEN);
                                                                              return(0);
   }  }
   if(0<F_DN[p]&&CURR<F_DN[p]+Actl)    // сделки актуальны
   {//NS[0]=GlobalVariableGet(NSE0[p])+0.1;
    //NB[1]=GlobalVariableGet(NBY1[p])+0.1;
      DLT=  GlobalVariableGet(DLOT[p]); if(DLT)KL=1.0; else KL=K;
      o[0][p]=true; o[1][p]=true;
      if(EXST[0]&&TS[0]==NS[0])        // позиция ещё не открыта
      {  if(0<TS[0])LOTS=KL*LotS[0][0];
         tm=TimeToStr(TimeCurrent(),TIME_DATE|TIME_MINUTES|TIME_SECONDS)+" ";
         if(AccountFreeMarginCheck(INST[0],OP_SELL,2*LOTS)<0)
         {o[0][p]=false;
          ERR[0][p]=tm+"("+p+") "+OPER[1]+INST[0]+" "+DoubleToStr(LOTS,2)
                                 +" - NOT enough money!";
          if(NEM==0)NEM=TimeCurrent(); // установить запрет на 60 секунд
         }
         else o[0][p]=OSEL(0,p,LOTS);if(o[0][p])
         {  /*
            oa="O0_"+TimeToStr(CURR,TIME_DATE|TIME_MINUTES|TIME_SECONDS);
            ObjectCreate(oa,OBJ_ARROW,0,CURR,BID[0]);
            ObjectSet   (oa,OBJPROP_ARROWCODE,1);
            ObjectSet   (oa,OBJPROP_COLOR,Sel);
            ObjectSet   (oa,OBJPROP_BACK,0);
            */
      }  }
      if(EXST[1]&&TB[1]==NB[1])        // позиция ещё не открыта
      {  if(0<TB[1])LOTS=KL*LotB[1][0];
         tm=TimeToStr(TimeCurrent(),TIME_DATE|TIME_MINUTES|TIME_SECONDS)+" ";
         if(  ( o[0][p]&&AccountFreeMarginCheck(INST[1],OP_BUY ,  LOTS)<0)
            ||(!o[0][p]&&AccountFreeMarginCheck(INST[1],OP_BUY ,2*LOTS)<0)   )
         {o[1][p]=false;
          ERR[1][p]=tm+"("+p+") "+OPER[0]+INST[1]+" "+DoubleToStr(LOTS,2)
                                 +" - NOT enough money!";
          if(NEM==0)NEM=TimeCurrent(); // установить запрет на 60 секунд
         }
         else o[1][p]=OBUY(1,p,LOTS);if(o[1][p])
         {  /*
            CL[0]=MarketInfo(INST[1],MODE_ASK)/POIN[1]+pVertShift+0.1;
            cl=NormalizeDouble(CL[0]*POIN[0],DIGT[0]);
            oa="O1_"+TimeToStr(CURR,TIME_DATE|TIME_MINUTES|TIME_SECONDS);
            ObjectCreate(oa,OBJ_ARROW,0,CURR,cl);
            ObjectSet   (oa,OBJPROP_ARROWCODE,1);
            ObjectSet   (oa,OBJPROP_COLOR,Buy);
            ObjectSet   (oa,OBJPROP_BACK,0);
            */
      }  }
      if(o[0][p]&&o[1][p])
      {  F_DN[p]=0;                    // портфель заполнен
         if(EXST[0])NS[0]++;
         if(EXST[1])NB[1]++;
         GlobalVariableSet(NSE0 [p], NS[0]);
         GlobalVariableSet(NBY1 [p], NB[1]);
         GlobalVariableSet(IENB [p], 0   );
         GlobalVariableSet(DLOT [p], 0   );
         GlobalVariableSet(PC[0][p], 0   );
         GlobalVariableSet(PC[1][p], 0   );
         GlobalVariableSet(PB[0][p], 0   );
         GlobalVariableSet(PB[1][p], 0   );
       //CLO[0]=""; CLO[1]="";
         if(5<=StringLen(OPEN))PlaySound(OPEN);
                                                                              return(0);
   }  }
//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
   Comm[p]=PAIN(p);
                                                                              return(0);
}
//---------------------------------------------------------------------------------------
                                       // НАПЕЧАТАТЬ ИНФОРМАЦИЮ НА ЭКРАНЕ
string   PAIN(int p)
{        string   ii,lo,mo,li,dd,dv,pp,qq,ll,wp,np,cp;//di0,di1,tc;
         int      st,st0,st1;
//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
   ii="_________________________________________________________________________________"
     +"__________________GROUP "+p+"__________\n";
   ii=ii+TimeToStr(TimeCurrent(),TIME_DATE|TIME_MINUTES|TIME_SECONDS)+"  ";
   if(FixLot)lo="Start lots - fixed: ("
               +DoubleToStr(STLT[0][p],2)+"+"+DoubleToStr(STLT[1][p],2)+")";
   else      lo="Start lots:"     +" ("
               +DoubleToStr(STLT[0][p],2)+"+"+DoubleToStr(STLT[1][p],2)+")";
   li="     Links opened: "+TMM+"   STEP="+Step+"\n";
  if(CUTTING_A||CUTTING_B)
  {if(2==PRT[p])mo="PARTIAL PROFIT MODE <B> (the limit was reached "
                  +DoubleToStr(DRSB,2)+"%   N="+DoubleToStr(N_B,2)+")\n\n";
   else
   if(1==PRT[p])mo="PARTIAL PROFIT MODE <A> (the limit was reached "
                  +DoubleToStr(DRSA,2)+"%   N="+DoubleToStr(N_A,2)+")\n\n";
   else         mo="ENTIRE  PROFIT MODE  (the limit is set "
                  +DoubleToStr(DRSA,2)+"%)\n\n";
  }else         mo="ENTIRE  PROFIT MODE\n\n";
   pp=DoubleToStr(TotProf[p],2); //if(BS0==0)st=0; else st=DF+BS0;
   qq=DoubleToStr(TotPerc[p],2);
 //if(0>st     )dv="-"+st;   if(0<=st    )dv="+"+st;   dv="  Divergence="+dv;
   if(0>DF     [p])dd="-"+DF  [p]; if(0<=DF    [p])dd="+"+DF  [p]; dd="Distance="+dd;
   if(0>LSTD   [p])dv="-"+LSTD[p]; if(0<=LSTD  [p])dv="+"+LSTD[p]; dv="  Step="  +dv;
   if(0>TotProf[p])pp="-"+pp;      if(0<TotProf[p])pp="+"+pp;      pp="  Profit="+pp;
   if(0>TotProf[p])qq="-"+qq;      if(0<TotProf[p])qq="+"+qq;      qq=" ("+qq+"%)";
                                                                   pp=pp+qq;
   cp=cp+"  ***  Closed= "    +DoubleToStr(GlobalVariableGet(PRFC[p]),2);
   if(DAY)  cp=cp+"  Day= "   +DoubleToStr(DPR[p],2);
   if(WEEK) cp=cp+"  Week= "  +DoubleToStr(WPR[p],2);
   if(MONTH)cp=cp+"  Month= " +DoubleToStr(MPR[p],2);
   cp=cp+"  Magic-profit= "   +DoubleToStr(TPR[p],2);
 //ii=lo+tc+di0+di1+mo+li+ii+dd+dv+pp+cp;
   ii=ii+lo+li+mo+dd+dv+pp+cp;
   st0=TB[0]+TS[0]; st1=TS[1]+TB[1]; np=INST[0]+"= "+st0+"   "+INST[1]+"= "+st1;
   ll="   Lots= ("+DoubleToStr(TotL[0],2)+"+"+DoubleToStr(TotL[1],2)+")";
   wp="   Wanted= "    +DoubleToStr(REQP[p],2);
   wp=wp+"  *** Max.Links= "  +DoubleToStr(nn  [p],0);
   wp=wp+"  Drawdown= "       +DoubleToStr(d0  [p],2);
   wp=wp+"  Magic-drawdown= " +DoubleToStr(dr  [p],2);
   ii=ii+"\n"+np+ll+wp+"\n\n";
   for(st=0;st<=1;st++)
   {  ii=ii+CLO[st][p]+OPE[st][p]+ERR[st][p]+"\n";
   }
   ii=ii+PAS[p];
 //Comment(ii);
                                                                              return(ii);
}
//---------------------------------------------------------------------------------------
                                       // ОТКРЫТЬ ПОЗИЦИЮ НА ПОКУПКУ
bool     OBUY(int i, int p, double l)
{        int      t,CDigits,oo=OP_BUY;
         bool     r=false,ov=false;
         double   CAsk,CPoint,lot;
         string   cur,tm,mes,com,opr;
//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
   if(0<NEM)                                                                  return(r);
   cur=INST[i]; lot=NLOT(l);
   tm=TimeToStr(TimeCurrent(),TIME_DATE|TIME_MINUTES|TIME_SECONDS)+" ";
   opr="("+p+") "+OPER[oo]+cur+" "+DoubleToStr(lot,2);
   if(MaxTotalLots<TotL[i]+lot)
   {  ERR[i][p]=tm+opr+" - MAX. total lots!" ; ov=true;
      GlobalVariableSet(OVER[p],1.1);
   }
   if(!ov)if(AccountFreeMarginCheck(cur,oo,lot)<0.0)
   {  ERR[i][p]=tm+opr+" - NOT enough money!"; ov=true;
      Alert("Not enough money for "+opr+" "+cur);
      NEM=TimeCurrent();               // установить запрет на 60 секунд
   }
   if(ov)                                                                     return(r);
//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
   mes=tm+"waiting for "+opr+" ..."; Comment(mes);
   WFTC(); CAsk=MarketInfo(cur,MODE_ASK);
   CPoint=   MarketInfo(cur,MODE_POINT); CDigits=MarketInfo(cur,MODE_DIGITS);
   com=DoubleToStr(MAG[p],0); SLIP=0.0001*SlipPP*CAsk/CPoint;
   opr=opr+" @ "+DoubleToStr(CAsk,CDigits);
   t=OrderSend(cur,oo,lot,CAsk,SLIP,0,0,com,MAG[p]);
   tm=TimeToStr(TimeCurrent(),TIME_DATE|TIME_MINUTES|TIME_SECONDS)+" ";
   if(0<t)
   {  mes=tm+opr+" - OK"; Comment(mes);
    //OPE[i][p]=OPE[i][p]+mes+"\n";          r=true;
      OPE[i][p]=          mes+"\n";          r=true;
   }
   else
   {  mes=tm+opr+" - FAILURE #"+GetLastError();
      Alert(mes); Comment(mes);
      ERR[i][p]=mes+"\n"; Sleep(5000);       r=false;
   }
   WLIN(mes);
                                                                              return(r);
}
//---------------------------------------------------------------------------------------
                                       // ОТКРЫТЬ ПОЗИЦИЮ НА ПРОДАЖУ
bool     OSEL(int i, int p, double l)
{        int      t,CDigits,oo=OP_SELL;
         bool     r=false,ov=false;
         double   CBid,CPoint,lot;
         string   cur,tm,mes,com,opr;
//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
   if(0<NEM)                                                                  return(r);
   cur=INST[i]; lot=NLOT(l);
   tm=TimeToStr(TimeCurrent(),TIME_DATE|TIME_MINUTES|TIME_SECONDS)+" ";
   opr="("+p+") "+OPER[oo]+cur+" "+DoubleToStr(lot,2);
   if(MaxTotalLots<TotL[i]+lot)
   {  ERR[i][p]=tm+opr+" - MAX. total lots!" ; ov=true;
      GlobalVariableSet(OVER[p],1.1);
   }
   if(!ov)if(AccountFreeMarginCheck(cur,oo,lot)<0.0)
   {  ERR[i][p]=tm+opr+" - NOT enough money!"; ov=true;
      Alert("Not enough money for "+opr+" "+cur);
      NEM=TimeCurrent();               // установить запрет на 60 секунд
   }
   if(ov)                                                                     return(r);
//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
   mes=tm+"waiting for "+opr+" ..."; Comment(mes);
   WFTC(); CBid=MarketInfo(cur,MODE_BID);
   CPoint=   MarketInfo(cur,MODE_POINT); CDigits=MarketInfo(cur,MODE_DIGITS);
   com=DoubleToStr(MAG[p],0); SLIP=0.0001*SlipPP*CBid/CPoint;
   opr=opr+" @ "+DoubleToStr(CBid,CDigits);
   t=OrderSend(cur,oo,lot,CBid,SLIP,0,0,com,MAG[p]);
   tm=TimeToStr(TimeCurrent(),TIME_DATE|TIME_MINUTES|TIME_SECONDS)+" ";
   if(0<t)
   {  mes=tm+opr+" - OK"; Comment(mes);
    //OPE[i][p]=OPE[i][p]+mes+"\n";          r=true;
      OPE[i][p]=          mes+"\n";          r=true;
   }
   else
   {  mes=tm+opr+" - FAILURE #"+GetLastError();
      Alert(mes); Comment(mes);
      ERR[i][p]=mes+"\n"; Sleep(5000);       r=false;
   }
   WLIN(mes);
                                                                              return(r);
}
//---------------------------------------------------------------------------------------
bool     CLOS(int p)                   // ЗАКРЫТЬ ПРИБЫЛЬ ПОЛНОСТЬЮ
{        int      k0,kk,k,i,CDigits,IT,TI[16384];
         bool     FB[2],FS[2],f,m,r=true;
         double   CAsk,CBid,CPoint,PR;
         string   opr,cur,tm,com,mes[2];
//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
   IT=0; k0=0;kk=4095;
   FB[0]=(0<TB[0]); FS[0]=(0<TS[0]); mes[0]="";
   FB[1]=(0<TB[1]); FS[1]=(0<TS[1]); mes[1]="";
   f=GlobalVariableGet(CLSE[p]);if(!f)
   { GlobalVariableSet(PRFC[p],0); GlobalVariableSet(CLSE[p],1.1);
   }
   for(k=k0;k<=kk;k++)
   {if(!FB[0]&&!FS[0]&&!FB[1]&&!FS[1])break;
    for(i=0;i<=1;i++)
    {cur=INST[i];
     if(k<TB[i])
     {opr="("+p+") "+OPER[OP_BUY ]+cur+" "+DoubleToStr(LotB[i][k],2);
      tm=TimeToStr(TimeCurrent(),TIME_DATE|TIME_MINUTES|TIME_SECONDS)+" ";
      com=tm+mes[0]+mes[1]+" waiting for closure of "+opr+" ..."; Comment(com);
      WFTC(); CBid=MarketInfo(cur,MODE_BID); CDigits=MarketInfo(cur,MODE_DIGITS);
      CPoint=MarketInfo(cur,MODE_POINT);  SLIP=0.0001*SlipPP*CBid/CPoint;
      opr=opr+" @ "+DoubleToStr(CBid,CDigits);
      m=OrderClose(B[i][k],LotB[i][k],CBid,2*SLIP); r=r&&m;
      tm=TimeToStr(TimeCurrent(),TIME_DATE|TIME_MINUTES|TIME_SECONDS)+" ";
      mes[i]=mes[i]+tm;
      if(m)
      {     mes[i]=mes[i]+opr+" - closed by <CLOS>\r\n";
            TI[IT]=B[i][k]; IT++;
      }
      else  mes[i]=mes[i]+opr+" - NOT closed by <CLOS> - FAILURE #"
                             +GetLastError()+"\r\n";
      Comment(mes[0]+mes[1]);
     }else FB[i]=false;
     if(k<TS[i])
     {opr="("+p+") "+OPER[OP_SELL]+cur+" "+DoubleToStr(LotS[i][k],2);
      tm=TimeToStr(TimeCurrent(),TIME_DATE|TIME_MINUTES|TIME_SECONDS)+" ";
      com=tm+mes[0]+mes[1]+" waiting for closure of "+opr+" ..."; Comment(com);
      WFTC(); CAsk=MarketInfo(cur,MODE_ASK); CDigits=MarketInfo(cur,MODE_DIGITS);
      CPoint=MarketInfo(cur,MODE_POINT);  SLIP=0.0001*SlipPP*CAsk/CPoint;
      opr=opr+" @ "+DoubleToStr(CAsk,CDigits);
      m=OrderClose(S[i][k],LotS[i][k],CAsk,2*SLIP); r=r&&m;
      tm=TimeToStr(TimeCurrent(),TIME_DATE|TIME_MINUTES|TIME_SECONDS)+" ";
      mes[i]=mes[i]+tm;
      if(m)
      {     mes[i]=mes[i]+opr+" - closed by <CLOS>\r\n";
            TI[IT]=S[i][k]; IT++;
      }
      else  mes[i]=mes[i]+opr+" - NOT closed by <CLOS> - FAILURE #"
                             +GetLastError()+"\r\n";
      Comment(mes[0]+mes[1]);
     }else FS[i]=false;
   }}
   PR=GlobalVariableGet(PRFC[p]);for(k=0;k<IT;k++)
   {  if(!OrderSelect(TI[k],SELECT_BY_TICKET))  continue;
      if(1>OrderCloseTime())                    continue;
      PR+=(OrderProfit()+OrderSwap()+OrderCommission());
   }GlobalVariableSet(PRFC[p],PR);
   WLIN(mes[0],0); CLO[0][p]=mes[0];
   WLIN(mes[1],0); CLO[1][p]=mes[1];
                                                                              return(r);
}
//---------------------------------------------------------------------------------------
bool     CUTA(int p)                   // ЗАКРЫТЬ ПРИБЫЛЬ ЧАСТИЧНО (схема CUTTING_A)
{        int      k0,kk,k,i,at,CDigits,IT,TI[16384];
         bool     FB[2],FS[2],m,r=false;
         double   CAsk,CBid,CPoint,PR;
         string   opr,cur,tm,com,mes[2];
//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
   IT=0; k0=0;kk=4095;
 //IT=0; k0=0;kk=   1;
   mes[0]=""; mes[1]="";
 //f=GlobalVariableGet(CLSE[p]);if(!f)
   { GlobalVariableSet(PRFC[p],0);//GlobalVariableSet(CLSE[p],1.1);
   }
   for(i=0;i<=1;i++)
   {for(k=0;k<=TS[i];k++)SMX[i][k]=false;
    for(k=0;k<=TB[i];k++)BMX[i][k]=false;
   }
//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
  for(at=1;at<=ATT&&!r;at++)
  {r=true;
   FB[0]=(0<TB[0]); FS[0]=(0<TS[0]);
   FB[1]=(0<TB[1]); FS[1]=(0<TS[1]);
   for(k=k0;k<=kk;k++)
   {if(!FB[0]&&!FS[0]&&!FB[1]&&!FS[1])break;
    for(i=0;i<=1;i++)
    {cur=INST[i];
     if(!BMX[i][k]&&k<TB[i]&&(0<LinkPrf[k]||k==TB[i]-1))
     {opr="("+p+") "+OPER[OP_BUY ]+cur+" "+DoubleToStr(LotB[i][k],2);
      tm=TimeToStr(TimeCurrent(),TIME_DATE|TIME_MINUTES|TIME_SECONDS)+" ";
      com=tm+mes[0]+mes[1]+" waiting for closure of "+opr+" ..."; Comment(com);
      WFTC(); CBid=MarketInfo(cur,MODE_BID); CDigits=MarketInfo(cur,MODE_DIGITS);
      CPoint=MarketInfo(cur,MODE_POINT);  SLIP=0.0001*SlipPP*CBid/CPoint;
      opr=opr+" @ "+DoubleToStr(CBid,CDigits);
      m=OrderClose(B[i][k],LotB[i][k],CBid,2*SLIP); r=r&&m;
      tm=TimeToStr(TimeCurrent(),TIME_DATE|TIME_MINUTES|TIME_SECONDS)+" ";
      mes[i]=mes[i]+tm;
      if(m)
      {     BMX[i][k]=true;
            mes[i]=mes[i]+opr+" - closed by <CUTA>\r\n";
            if(k==0)
            {CAsk=MarketInfo(cur,MODE_ASK);GlobalVariableSet(PC[i][p],CAsk);
            }
            TI[IT]=B[i][k]; IT++;
      }
      else  mes[i]=mes[i]+opr+" - NOT closed by <CUTA> (attempt "+at+") - FAILURE # "
                             +GetLastError()+"\r\n";
      Comment(mes[0]+mes[1]);
     }else if(k>=TB[i])FB[i]=false;
     if(!SMX[i][k]&&k<TS[i]&&(0<LinkPrf[k]||k==TS[i]-1))
     {opr="("+p+") "+OPER[OP_SELL]+cur+" "+DoubleToStr(LotS[i][k],2);
      tm=TimeToStr(TimeCurrent(),TIME_DATE|TIME_MINUTES|TIME_SECONDS)+" ";
      com=tm+mes[0]+mes[1]+" waiting for closure of "+opr+" ..."; Comment(com);
      WFTC(); CAsk=MarketInfo(cur,MODE_ASK); CDigits=MarketInfo(cur,MODE_DIGITS);
      CPoint=MarketInfo(cur,MODE_POINT);  SLIP=0.0001*SlipPP*CAsk/CPoint;
      opr=opr+" @ "+DoubleToStr(CAsk,CDigits);
      m=OrderClose(S[i][k],LotS[i][k],CAsk,2*SLIP); r=r&&m;
      tm=TimeToStr(TimeCurrent(),TIME_DATE|TIME_MINUTES|TIME_SECONDS)+" ";
      mes[i]=mes[i]+tm;
      if(m)
      {     SMX[i][k]=true;
            mes[i]=mes[i]+opr+" - closed by <CUTA>\r\n";
            if(k==0)
            {CBid=MarketInfo(cur,MODE_BID);GlobalVariableSet(PC[i][p],CBid);
            }
            TI[IT]=S[i][k]; IT++;
      }
      else  mes[i]=mes[i]+opr+" - NOT closed by <CUTA> (attempt "+at+") - FAILURE #"
                             +GetLastError()+"\r\n";
      Comment(mes[0]+mes[1]);
     }else if(k>=TS[i])FS[i]=false;
  }}}
//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
   PR=GlobalVariableGet(PRFC[p]);for(k=0;k<IT;k++)
   {  if(!OrderSelect(TI[k],SELECT_BY_TICKET))  continue;
      if(1>OrderCloseTime())                    continue;
      PR+=(OrderProfit()+OrderSwap()+OrderCommission());
   }GlobalVariableSet(PRFC[p],PR);
   WLIN(mes[0],0); CLO[0][p]=mes[0];
   WLIN(mes[1],0); CLO[1][p]=mes[1];
                                                                              return(r);
}
//---------------------------------------------------------------------------------------
bool     CUTB(int p)                   // ЗАКРЫТЬ ПРИБЫЛЬ ЧАСТИЧНО (схема CUTTING_B)
{        int      k0,kk,k,i,at,CDigits,IT,TI[16384];
         bool     FB[2],FS[2],m,r=false;
         double   CAsk,CBid,CPoint,PR;
         string   opr,cur,tm,com,mes[2];
//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
 //IT=0; k0=0;kk=4095;
   IT=0; k0=0;kk=   1;
   mes[0]=""; mes[1]="";
 //f=GlobalVariableGet(CLSE[p]);if(!f)
   { GlobalVariableSet(PRFC[p],0);//GlobalVariableSet(CLSE[p],1.1);
   }
   for(i=0;i<=1;i++)
   {for(k=0;k<=TS[i];k++)SMX[i][k]=false;
    for(k=0;k<=TB[i];k++)BMX[i][k]=false;
   }
//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
  for(at=1;at<=ATT&&!r;at++)
  {r=true;
   FB[0]=(0<TB[0]); FS[0]=(0<TS[0]);
   FB[1]=(0<TB[1]); FS[1]=(0<TS[1]);
   for(k=k0;k<=kk;k++)
   {if(!FB[0]&&!FS[0]&&!FB[1]&&!FS[1])break;
    for(i=0;i<=1;i++)
    {cur=INST[i];
     if(!BMX[i][k]&&k<TB[i])
     {opr="("+p+") "+OPER[OP_BUY ]+cur+" "+DoubleToStr(LotB[i][k],2);
      tm=TimeToStr(TimeCurrent(),TIME_DATE|TIME_MINUTES|TIME_SECONDS)+" ";
      com=tm+mes[0]+mes[1]+" waiting for closure of "+opr+" ..."; Comment(com);
      WFTC(); CBid=MarketInfo(cur,MODE_BID); CDigits=MarketInfo(cur,MODE_DIGITS);
      CPoint=MarketInfo(cur,MODE_POINT);  SLIP=0.0001*SlipPP*CBid/CPoint;
      opr=opr+" @ "+DoubleToStr(CBid,CDigits);
      m=OrderClose(B[i][k],LotB[i][k],CBid,2*SLIP); r=r&&m;
      tm=TimeToStr(TimeCurrent(),TIME_DATE|TIME_MINUTES|TIME_SECONDS)+" ";
      mes[i]=mes[i]+tm;
      if(m)
      {     BMX[i][k]=true;
            mes[i]=mes[i]+opr+" - closed by <CUTB>\r\n";
            if(k==1)
            {CAsk=MarketInfo(cur,MODE_ASK);GlobalVariableSet(PB[i][p],CAsk);
            }
            TI[IT]=B[i][k]; IT++;
      }
      else  mes[i]=mes[i]+opr+" - NOT closed by <CUTB> (attempt "+at+") - FAILURE #"
                         +GetLastError()+"\r\n";
      Comment(mes[0]+mes[1]);
     }else FB[i]=false;
     if(!SMX[i][k]&&k<TS[i])
     {opr="("+p+") "+OPER[OP_SELL]+cur+" "+DoubleToStr(LotS[i][k],2);
      tm=TimeToStr(TimeCurrent(),TIME_DATE|TIME_MINUTES|TIME_SECONDS)+" ";
      com=tm+mes[0]+mes[1]+" waiting for closure of "+opr+" ..."; Comment(com);
      WFTC(); CAsk=MarketInfo(cur,MODE_ASK); CDigits=MarketInfo(cur,MODE_DIGITS);
      CPoint=MarketInfo(cur,MODE_POINT);  SLIP=0.0001*SlipPP*CAsk/CPoint;
      opr=opr+" @ "+DoubleToStr(CAsk,CDigits);
      m=OrderClose(S[i][k],LotS[i][k],CAsk,2*SLIP); r=r&&m;
      tm=TimeToStr(TimeCurrent(),TIME_DATE|TIME_MINUTES|TIME_SECONDS)+" ";
      mes[i]=mes[i]+tm;
      if(m)
      {     SMX[i][k]=true;
            mes[i]=mes[i]+opr+" - closed by <CUTB>\r\n";
            if(k==1)
            {CBid=MarketInfo(cur,MODE_BID);GlobalVariableSet(PB[i][p],CBid);
            }
            TI[IT]=S[i][k]; IT++;
      }
      else  mes[i]=mes[i]+opr+" - NOT closed by <CUTB> (attempt "+at+") - FAILURE #"
                             +GetLastError()+"\r\n";
      Comment(mes[0]+mes[1]);
     }else FS[i]=false;
  }}}
   PR=GlobalVariableGet(PRFC[p]);for(k=0;k<IT;k++)
   {  if(!OrderSelect(TI[k],SELECT_BY_TICKET))  continue;
      if(1>OrderCloseTime())                    continue;
      PR+=(OrderProfit()+OrderSwap()+OrderCommission());
   }GlobalVariableSet(PRFC[p],PR);
   WLIN(mes[0],0); CLO[0][p]=mes[0];
   WLIN(mes[1],0); CLO[1][p]=mes[1];
                                                                              return(r);
}
//---------------------------------------------------------------------------------------
bool     WFTC()                        // ЖДАТЬ ОСВОБОЖДЕНИЕ ТОРГОВОГО ПОТОКА
{        int      sec=0;
         bool     r=false;
//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
   while(IsTradeContextBusy()&&sec<Wait)
   {  Sleep(1000); RefreshRates(); sec++;
   }RefreshRates();
   if(sec<Wait)r=true;
                                                                              return(r);
}
//---------------------------------------------------------------------------------------
double   NLOT(double lot)              // ОКРУГЛИТЬ ЛОТЫ ДО РАЗРЕШЁННЫХ
{        double   l,st,mi,ma;
         int      r;
//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
   ma=MarketInfo(INST[0],MODE_MAXLOT);
   mi=MarketInfo(INST[0],MODE_MINLOT);
   st=MarketInfo(INST[0],MODE_LOTSTEP);
   r=MathRound(lot/st)+0.1; l=st*r;
   if(l<mi)l=mi; if(ma<l)l=ma;
   l=NormalizeDouble(l,2);
                                                                              return(l);
}
//---------------------------------------------------------------------------------------
double   CPRF(int r, int tfr=0)        // ПОДСЧИТАТЬ ЗАКРЫТУЮ ПРИБЫЛЬ ЗА ПЕРИОД <tfr>
{        int      m,t,k=0,st=0;
         double   p=0;
         string   s;
       //datetime e;
//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
   if(0<tfr)for(;k<5;k++)
   {  st=iTime(INST[0],tfr,0);
      if(st!=0)break;
      if(GetLastError()==4066)Sleep(1000);                              else  return(p);
   }                                                                 if(k==5) return(p);
   for(k=OrdersHistoryTotal()-1;0<=k;k--)
   {  if(!OrderSelect(k,SELECT_BY_POS,MODE_HISTORY))           continue;
      t=OrderOpenTime();                              if(t<st) break;
      m=OrderMagicNumber();s=OrderSymbol();
      if(m!=MAG[r]||(s!=INST[0]&&s!=INST[1]))                  continue;
      p+=(OrderProfit()+OrderSwap()+OrderCommission());
   }
                                                                              return(p);
}
//---------------------------------------------------------------------------------------
void     WTIT()                        // ЗАПИСАТЬ ТИТУЛ В ОТДЕЛЬНЫЙ ЖУРНАЛ
{        int      h,len;
         string   Inf, Nlw;
//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
   if(OPT)                                                                    return;
   h=FileOpen(LOG_FILE[1],FILE_BIN|FILE_READ|FILE_WRITE);
   if(h<0)
   {  Alert("Inaccessible file <"+LOG_FILE[1]+">!\n");                        return;
   }
   FileSeek(h,0,SEEK_END);
   Inf="\r\n**********************************************"
          +"******************************************\r\n"
          +"  "+TimeToStr(TimeCurrent())+"  "+SCHEME_NAME+"\r\n"
          +"  ACCOUNT="+AccountNumber()/*+"\r\n"*/
          +"  Magic1="+MAG[1]+"  Magic2="+MAG[2]+"\r\n"
          +"**********************************************"
          +"******************************************\r\n";
   len=StringLen(Inf);
   FileWriteString(h,Inf,len);
         Inf=    "FINISH=                "+FBOOL(FINISH           )+"\r\n";
         Inf=Inf+"CUTTING_A=             "+FBOOL(CUTTING_A        )+"\r\n";
         Inf=Inf+"CUTTING_B=             "+FBOOL(CUTTING_B        )+"\r\n";
         Inf=Inf+"q_A=                   "+FDBU(q_A              )+"\r\n";
         Inf=Inf+"q_B=                   "+FDBU(q_B              )+"\r\n";
         Inf=Inf+"N_A=                   "+FDBU(N_A              )+"\r\n";
         Inf=Inf+"N_B=                   "+FDBU(N_B              )+"\r\n";
         Inf=Inf+"I___Ticker=            "+     I___Ticker        +"\r\n";
         Inf=Inf+"II__Ticker=            "+     II__Ticker        +"\r\n";
         Inf=Inf+"Ind_TF=                "+     Ind_TF            +"\r\n";
         Inf=Inf+"Ind_Ticker=            "+     Ind_Ticker        +"\r\n";
         Inf=Inf+"MAPeriod=              "+FINU(MAPeriod         )+"\r\n";
         Inf=Inf+"MAType=                "+FINU(MAType           )+"\r\n";
         Inf=Inf+"Step1=                 "+FINU(Step1            )+"\r\n";
         Inf=Inf+"Step2=                 "+FINU(Step2            )+"\r\n";
         Inf=Inf+"LinksChangingStep=     "+FINU(LinksChangingStep)+"\r\n";
   len=StringLen(Inf);
   FileWriteString(h,Inf,len);
         Inf=    "FixLot=                "+FBOOL(FixLot           )+"\r\n";
         Inf=Inf+"Lot=                   "+FDBU(Lot              )+"\r\n";
         Inf=Inf+"Y=                     "+FDBU(Y                )+"\r\n";
         Inf=Inf+"K=                     "+FDBU(K                )+"\r\n";
         Inf=Inf+"MaxTotalLots=          "+FDBU(MaxTotalLots     )+"\r\n";
         Inf=Inf+"Type_close=            "+     Type_close        +"\r\n";
         Inf=Inf+"n=                     "+FDBU(n                )+"\r\n";
         Inf=Inf+"ActualTime=            "+FINU(ActualTime       )+"\r\n";
         Inf=Inf+"----------------------------------------------"
                +"------------------------------------------\r\n";
   len=StringLen(Inf);
   FileWriteString(h,Inf,len);
   FileClose(h);
}
//---------------------------------------------------------------------------------------
void     WLIN(string inf, int lf=1)    // ЗАПИСАТЬ СТРОКУ В ОТДЕЛЬНЫЙ ЖУРНАЛ
{        int      h,len;
         string   lin;
//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
   if(OPT)                                                                    return;
   if(lf==1)lin=inf+"\r\n"; else lin=inf; len=StringLen(lin);
   h=FileOpen(LOG_FILE[1],FILE_BIN|FILE_READ|FILE_WRITE);
   if(h<0)
   {  Alert("Inaccessible file <"+LOG_FILE[1]+">!\n");                        return;
   }
   FileSeek(h,0,SEEK_END);
   FileWriteString(h,lin,len);
   FileClose(h);
}
//---------------------------------------------------------------------------------------
