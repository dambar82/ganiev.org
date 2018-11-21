<?php

use yii\db\Migration;

/**
 * Handles the creation of table `alphabet`.
 */
class m181121_105151_create_alphabet_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('alphabet', [
            'id' => $this->primaryKey(),
            'uppercase' => $this->string(),
            'lowercase' => $this->string(),
            'letter_audio' => $this->string(),
            'word' => $this->string(),
            'word_audio' => $this->string(),
            'word_image' => $this->string()
        ]);

        $this->batchInsert('alphabet', ['uppercase', 'lowercase', 'letter_audio', 'word', 'word_audio', 'word_image'], [
            ["А", "а", "http://balasuzlek.ru/files/audio/1/KFSfwUr_NVKsM3UsVku4EqSVS-x67HcH.mp3", "аю", "http://balasuzlek.ru/files/audio/1/r1NhBZ9d_4TiJ1E9y05geI5SoKaHW7Ax.mp3", "http://balasuzlek.ru/files/images/1/PX8vgbDKhG0UM9uQkjywXHB8UDET_qcp.png"],
            ["Ә", "ә", "http://balasuzlek.ru/files/audio/1/ucskOCmVbQYQ4pOz9zCG3CsYrFED6JdG.mp3", "Әтәч", "http://balasuzlek.ru/files/audio/1/QnRE3OUVhna2WVB1-thXDXTZt-x8xNIh.mp3", "http://balasuzlek.ru/files/images/1/eQ2WELkr8mTZCPpcl8ZromeCxAg0SDgv.png"],
            ["Б", "б", "http://balasuzlek.ru/files/audio/1/E83eLK9dRgKgYM8cJYPx7qPLIskFEyA_.mp3", "балык", "http://balasuzlek.ru/files/audio/1/J2o4vNPhbGzL_nwZWlbj63YFNN3eDEGJ.mp3", "http://balasuzlek.ru/files/images/1/RrwluZeBUKcKwnUlfgYBcl6lNYCfLvVv.png"],
            ["В", "в", "http://balasuzlek.ru/files/audio/1/8GKb8E2aMgoafRlBLYdZ64DmAZivJJt-.mp3", "вафли", "http://balasuzlek.ru/files/audio/1/GcK8pnSAf2Jof3WOgCt5j8su027UOX9-.mp3", "http://balasuzlek.ru/files/images/1/9sLneyHFaZTq-OIt8HodVoJFsoqB9rtz.png"],
            ["Г", "г", "http://balasuzlek.ru/files/audio/1/4R-KZ-yvea_H4R6ofrbZP0afGEQTm-ng.mp3", "гөмбә", "http://balasuzlek.ru/files/audio/1/Usz0uoIGpAK2J5HHhNw1rX0gJHLIR_If.mp3", "http://balasuzlek.ru/files/images/1/Ws2BmBVAEeMONtScGWyMevBbgyv1PNb9.png"],
            ["Д", "д", "http://balasuzlek.ru/files/audio/1/fTHNJBfq3C39Z7T4-nquO0hKRRI0T4hu.mp3", "даруханә", "http://balasuzlek.ru/files/audio/1/-VK2K3FmGtGE-qB0qi-KtLiFWes-qUTn.mp3", "http://balasuzlek.ru/files/images/1/EcU3ewNwBxPBvjk0zZYQ04_wMt5WyNRW.png"],
            ["Е", "е", "http://balasuzlek.ru/files/audio/1/o5mqextEx8-5Jlu7eobnXaLwfseEvATG.mp3", "елан", null, "http://balasuzlek.ru/files/images/1/Pg_y86Q6iQf3_k47P2YinR8ah39yKWQH.png"],
            ["Ё", "ё", "http://balasuzlek.ru/files/audio/1/p6hETanxB_GGQepdiKKmY5vH3b_ed3Db.mp3", "Ё", null, "http://balasuzlek.ru/files/images/1/viGWT1Kq38Jz8Gs3nnss4oRUhyj9wzlg.png"],
            ["Ж", "ж", "http://balasuzlek.ru/files/audio/1/Qa7pS0E0AB4HxvThz5y4bppjqz9FoD_J.mp3", " ", null, "http://balasuzlek.ru/files/images/1/PAw8-TvFVMoa-_7MDjfpFpbaODhRNaQ2.png"],
            ["Җ", "җ", "http://balasuzlek.ru/files/audio/1/QIcZcCCPLMoLr5gJbdm744CdRPTWd5Hq.mp3", "җиләк", "http://balasuzlek.ru/files/audio/1/6O8-77Iwvzsb9BG_XhVEQpz8miq6N3rK.mp3", "http://balasuzlek.ru/files/images/1/a0_tXSR_EZbzeuVbkGqXsbWTGpSOj35A.png"],
            ["З", "з", "http://balasuzlek.ru/files/audio/1/zPbctNuAH4z3x3Jjp1HR3JB-05FqLG9B.mp3", "зәңгәр", "http://balasuzlek.ru/files/audio/1/IcZw3LrQvZTX5mFU2e3SAysSByOPhrha.mp3", "http://balasuzlek.ru/files/images/1/ca8xsyb4kMTwbbF_dTmfHNqSbGTQFx1a.png"],
            ["И", "и", "http://balasuzlek.ru/files/audio/1/QN3iJXcnYNr_YL_AeSOdifE6QfEJ0HE4.mp3", "ипи, икмәк", "http://balasuzlek.ru/files/audio/1/YeNRa_WjM9NOwlYRBAXSbgP9Dqkw5WsE.mp3", "http://balasuzlek.ru/files/images/1/F7JPIndqVyNwXS7w_DmySzyXbgF-OXZM.png"],
            ["Й", "й", "http://balasuzlek.ru/files/audio/1/hkXUQ7J8DHDLRy37ZGW4ylF4V4ScAyp3.mp3", "йозак", "http://balasuzlek.ru/files/audio/1/uG90iOxS8K4A32tldusso6pCkzYZ4HFU.mp3", "http://balasuzlek.ru/files/images/1/kq5g3jX4HqsXGRa3jDC-aWwDBP2A-v59.png"],
            ["К", "к", "http://balasuzlek.ru/files/audio/1/wEhJP6T11EAhsm1MlpH-VJOtUu59Dew-.mp3", "карбыз", "http://balasuzlek.ru/files/audio/1/QNTG2P_ZiSRtII1o2BnZGdFjw8NHTd8D.mp3", "http://balasuzlek.ru/files/images/1/DOmIOjvDEEFCWpA1EQ6jtaKtqrHnCJQu.png"],
            ["Л", "л", "http://balasuzlek.ru/files/audio/1/gfj54sbVdt6vNzbDTylPFylcG2B5E3CZ.mp3", "лимон", "http://balasuzlek.ru/files/audio/1/uDdNgkW8LX1M22wnFC4rd6ZoM_21_T0W.mp3", "http://balasuzlek.ru/files/images/1/pQwgwt8jgserDboLMFobR3qRrB6PHd0f.png"],
            ["М", "м", "http://balasuzlek.ru/files/audio/1/3NdLjDQ8Yd1JlMXIur2-E024xd8cu7WY.mp3", "маймыл", null, "http://balasuzlek.ru/files/images/1/SO899LniVbClygVBJpAxsFillmw-vUX2.png"],
            ["Н", "н", "http://balasuzlek.ru/files/audio/1/hIy_0skw6TWdP76rkg0pMT3VR4_a9Q25.mp3", "нарат", null, "http://balasuzlek.ru/files/images/1/FTxmPezheO58ykjKcpEcnmNLktcGyonR.png"],
            ["Ң", "ң", "http://balasuzlek.ru/files/audio/1/yckc4pJ6CceAKMh0LCKSQ3bl3vR2PV07.mp3", " ", null, "http://balasuzlek.ru/files/images/1/-qMKtW3panoOBeE4HfBm_6s0WUta2zYg.png"],
            ["О", "о", "http://balasuzlek.ru/files/audio/1/uFdWT_yq5dIeXDqE7kqtUuejKoClYThL.mp3", "он", "http://balasuzlek.ru/files/audio/1/cz79aC-Zso13yi40VuaOSSfsdwxNHQBR.mp3", "http://balasuzlek.ru/files/images/1/Tsq_f3lJmI52c3olNbIQUE9HWXaAcJpr.png"],
            ["Ө", "ө", "http://balasuzlek.ru/files/audio/1/Rx3bNx7LsLf2FR3LPKwfOakKb4_b6MiY.mp3", "өй", "http://balasuzlek.ru/files/audio/1/GE7PMkZ52mLQJwy9dQsOoLSSIuGBiOjD.mp3", "http://balasuzlek.ru/files/images/1/6ZVz1C70rTl1E4omqXuF5cxLdqVfOFNT.png"],
            ["П", "п", "http://balasuzlek.ru/files/audio/1/cvZU5Ls__z3dnaMy8MzTXso0g6bkq0NF.mp3", "плитә", "http://balasuzlek.ru/files/audio/1/i-QQ8kjqtvFj-t2PZ28Ugq5F20FwXCKN.mp3", "http://balasuzlek.ru/files/images/1/idl3e6mVSqi0lsn46UQtAQBziyYJTd4R.png"],
            ["Р", "р", "http://balasuzlek.ru/files/audio/1/LezTw0Q3oG1gtE4uKbnNs3NZSOTm4ug0.mp3", "рәсем", "http://balasuzlek.ru/files/audio/1/U9RswIOY2kjjN3lUoptgUMabTShyeP1k.mp3", "http://balasuzlek.ru/files/images/1/m099q71xEAMhVrOGsevuLPoi79GXQyEs.png"],
            ["С", "с", "http://balasuzlek.ru/files/audio/1/bXzOKXa_8wcKjckna-CNVjNfXiun1bAW.mp3", "савыт", "http://balasuzlek.ru/files/audio/1/KDHM_CVP9NwoSZ65HKjbJ_LSQjKR5s3n.mp3", "http://balasuzlek.ru/files/images/1/lpfV21WdQa8pKKKwYUQ3QmRDL1MWdR9v.png"],
            ["Т", "т", "http://balasuzlek.ru/files/audio/1/evO_FCec_CDlvp-2wRCm5pTuU61ogW6g.mp3", "туп", "http://balasuzlek.ru/files/audio/1/j5ewxWbZQeC86IbGROuWyeWL99pw8rHV.mp3", "http://balasuzlek.ru/files/images/1/83tFCxo_w5uQwfCKgWQGNpeQbfr3nGar.png"],
            ["У", "у", "http://balasuzlek.ru/files/audio/1/KNCVoH8RKiD938_zn5Wnyq__qX7JF1fn.mp3", "урындык", "http://balasuzlek.ru/files/audio/1/Zn1Ixl2StrpwR_S7y0aFyx3nJkK5pt9M.mp3", "http://balasuzlek.ru/files/images/1/WgwHskTr_nz6wQAeL7_7GUh2tneujSll.png"],
            ["Ү", "ү", "http://balasuzlek.ru/files/audio/1/hAByJrYl3G_njyTPgpLfqurNiQwn6Hed.mp3", "үрдәк", "http://balasuzlek.ru/files/audio/1/Hcb1B04dTbOpaEKpHHncm1xYEYNAnY05.mp3", "http://balasuzlek.ru/files/images/1/VMZCMc3g_vWoFadibPIpyxke5wdbvANz.png"],
            ["Ф", "ф", "http://balasuzlek.ru/files/audio/1/GXHFSuadWELtHyIhc8me-xkPsC-8xYCC.mp3", "футбол", "http://balasuzlek.ru/files/audio/1/CG_MOdedtnVBjjA6YNqCcpdLLoRKXnWv.mp3", "http://balasuzlek.ru/files/images/1/AAasU3N8pHk2yshE2z4lXsyjCVAnDR6h.png"],
            ["Х", "х", "http://balasuzlek.ru/files/audio/1/DIjJ1v96BPAoYIfoWkY5upaYlTcVbVSo.mp3", "хөрмә", "http://balasuzlek.ru/files/audio/1/HSMkQkjBkIwZ83-UBmq9FruKYYztwSMO.mp3", "http://balasuzlek.ru/files/images/1/XWjDfeI7sXuYGiZV-EUdOy3bzD7DrZGL.png"],
            ["Һ", "һ", "http://balasuzlek.ru/files/audio/1/Z8H1zoamOZugcRg5tSbZKxnYi9TweUcG.mp3", " ", null, "http://balasuzlek.ru/files/images/1/95-3HUg3gx2EehQ8xkMqtua6T73ehGVH.png"],
            ["Ц", "ц", "http://balasuzlek.ru/files/audio/1/nNbd3M69ymROklYeLwJv32TilOZVRis-.mp3", "цирк", "http://balasuzlek.ru/files/audio/1/o7RExWFFFnwnChCBoSACIWChK4xEJR_G.mp3", "http://balasuzlek.ru/files/images/1/FJMDGOsoerzp8GEcpugegmZYoG2L-Q-3.png"],
            ["Ч", "ч", "http://balasuzlek.ru/files/audio/1/eNlTIlKP_YI61-Eg-rCuKBhsi3U_4_jc.mp3", "чынаяк", "http://balasuzlek.ru/files/audio/1/Gn2hH5-X16zE8cOvE7Ry9zbOp26yXFVd.mp3", "http://balasuzlek.ru/files/images/1/3g2t8VJakDFBjuZr8moIJDM1mSf3--ux.png"],
            ["Ш", "ш", "http://balasuzlek.ru/files/audio/1/Gpw_q45IiBZ6Xz35aiRyGm_0jNC8_Cc8.mp3", "шахмат", "http://balasuzlek.ru/files/audio/1/uSiH0Cwidx5qkVWBdATx-w4EajKEdPn3.mp3", "http://balasuzlek.ru/files/images/1/aajrCV8uPXjP_SNDzBODb4aWx6Ssnb-T.png"],
            ["Щ", "щ", "http://balasuzlek.ru/files/audio/1/gdgOTawUND2Pep4ufBz9ZtyHKdSkEbL7.mp3", " ", null, "http://balasuzlek.ru/files/images/1/vP31-flvGUKqS3Oy3O0KwrVMbx2Pl3GM.png"],
            ["Ъ", "ъ", "http://balasuzlek.ru/files/audio/1/e-z2z719eJIL2jecJUHbFDrh8r1Fjn5A.mp3", " ", null, "http://balasuzlek.ru/files/images/1/Dr1o2J2mzeb7rmjj8GcbvhpHnHNvV2iP.png"],
            ["Ы", "ы", "http://balasuzlek.ru/files/audio/1/bQ14HcJyaUK7o5OADJT1pNlJ_np7QiaT.mp3", " ", null, "http://balasuzlek.ru/files/images/1/c4VfjfIl02Htrfa3SOKc9vV7EAjHte2l.png"],
            ["Ь", "ь", "http://balasuzlek.ru/files/audio/1/YwAxLAMz5LlER9-BaO7wRq1D3iHTJX34.mp3", " ", null, "http://balasuzlek.ru/files/images/1/Kgd9TS-rjCIsTn0FMs-p7yCFSFUWger-.png"],
            ["Э", "э", "http://balasuzlek.ru/files/audio/1/ZWlCJcTjTEY4FlJ56G8V8a3ix-xZuigX.mp3", "эт", "http://balasuzlek.ru/files/audio/1/IzfRJIFjMWlwvOa9tPjP9wMvybgbzW4x.mp3", "http://balasuzlek.ru/files/images/1/lUjH-gRdNZiPsI-WU0GfZoKyhSj0bPfF.png"],
            ["Ю", "ю", "http://balasuzlek.ru/files/audio/1/UUWFAqudHlbxHrUqaRMfAjs7ypy7MZmT.mp3", "юынгыч", "http://balasuzlek.ru/files/audio/1/nXaxxxAfRZEJV9MDQh5X5dFSVwsK5gjk.mp3", "http://balasuzlek.ru/files/images/1/Crm86eDHG2X9urH7ZEnIyK0OoY3vo2eP.png"],
            ["Я", "я", "http://balasuzlek.ru/files/audio/1/ibdsurvh8cSbfi148AQpqs-gY1C-pNdk.mp3", "яз", "http://balasuzlek.ru/files/audio/1/ILYUYIXfPh1jOfskoyAaoJMYcDyQ8V7k.mp3", "http://balasuzlek.ru/files/images/1/iTP70ZUMZGupbyXYXT3kqFRCUeZuENWF.png"]
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('alphabet');
    }
}
