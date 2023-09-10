import IconLaslesVpn from "./assets/Logo.png";
import Ilustration1 from "./assets/Illustration_1.png";
import IconMaps from "./assets/maps.png";
import IconUsers from "./assets/users.png";
import IconServer from "./assets/server.png";
import Ilustration2 from "./assets/Illustration_2.png";
import Check from "./assets/Check.png";
import Global from "./assets/Huge_Global.png";
import Netflix from "./assets/sosmed/Netflix.png";
import Spotify from "./assets/sosmed/Spotify.png";
import Discord from "./assets/sosmed/Discord.png";
import reddit from "./assets/sosmed/reddit.png";

import "slick-carousel/slick/slick.css";
import "slick-carousel/slick/slick-theme.css";
import CardPlan from "./components/CardPlan";
import Review from "./components/Review";
import TitleDesc from "./components/TitleDesc";
import SubscribeNow from "./components/SubscribeNow";
import axios from "axios";
import React, { useState, useEffect } from 'react';

function App() {
  const menus = ["Tentang", "Fitur", "Harga", "Testimoni", "Bantuan"];

  const [data, setData] = useState([]);

  useEffect(() => {
    // Menggunakan Axios untuk melakukan permintaan GET ke API
    axios.get('http://127.0.0.1:8000/api/bantuans')
      .then(response => {
        // Mengatur data yang diterima dari API ke state 'data'
        setData(response.data.data);
      })
      .catch(error => {
        console.error('Terjadi kesalahan saat mengambil data:', error);
      });
  }, []);


  const [tentang, SetTentang] = useState([]);

  useEffect(() => {
    // Menggunakan Axios untuk melakukan permintaan GET ke API
    axios.get('http://127.0.0.1:8000/api/tentangs')
      .then(response => {
        // Mengatur data yang diterima dari API ke state 'data'
      SetTentang(response.data.data);
      })
      .catch(error => {
        console.error('Terjadi kesalahan saat mengambil data:', error);
      });
  }, );
  
  const section3 = [
    {
      icon: IconMaps,
      lable: "users",
      total: "30+",
    },
    {
      icon: IconUsers,
      lable: "users",
      total: "30+",
    },
    {
      icon: IconServer,
      lable: "users",
      total: "30+",
    },
  ];

  const features = [
    "Maintance Problems",
    "24/7 Support & Help",
    "Fixing Issues",
    "No specific time limits.",
  ];

  

  const plans = [
    {
      title: "Free Plan",
      features: [
        "Unlimited Bandwitch",
        "Encrypted Connection",
        "No Traffic Logs",
        "Works on All Devices",
      ],
      price: "Free",
    },
    {
      title: "Standard Plan",
      features: [
        "Unlimited Bandwitch",
        "Encrypted Connection",
        "No Traffic Logs",
        "Works on All Devices",
        "Connect Anyware",
      ],
      price: "$9 / mo",
    },
    {
      title: "Premium Plan",
      features: [
        "Unlimited Bandwitch",
        "Encrypted Connection",
        "No Traffic Logs",
        "Works on All Devices",
        "Connect Anyware",
        "Connect Anyware",
      ],
      price: "$12 / mo",
    },
  ];


  const sosmed = [Discord, reddit, Netflix, Spotify];

  return (
    <div className="bg-white">
      <header className="container max-w-5xl mx-auto flex flex-row pt-12 items-center space-x-36">
        <img alt="icon-laslesvpn" src={IconLaslesVpn} className="w-36" />
        <div className="flex-1">
          <ul className="flex flex-row space-x-6">
            {menus.map((val, index) => (
              <li key={index}>{val}</li>
            ))}
          </ul>
        </div>
        <div className="space-x-6 flex flex-row items-center ">
          <button className="border border-red-500 rounded-full py-2 px-6">
            Daftar
          </button>
        </div>
      </header>
      <main>
        <div className="container max-w-5xl mx-auto  grid grid-cols-2 py-24">
          <div>
            <h1 className="font-bold text-4xl pb-5">
              COKNET
            </h1>
            <div className="font-normal text-xs pb-12">
            Jasa Telekomunikasi Terkemuka di Indonesia menyediakan layanan Internet super cepat dan handal untuk memenuhi kebutuhan pelanggan dari segmen rumahan, korporasi, hingga reseller penyedia layanan Internet di seluruh Nusantara.
            </div>
            <button className="py-4 px-16 bg-red-500 rounded-md text-white drop-shadow-3xl">
              Get Started
            </button>
          </div>
          <div>
            <img src={Ilustration1} alt="ilustration-laslesvpn" />
          </div>
        </div>
        <div className="container max-w-5xl mx-auto grid grid-cols-3 shadow-2xl rounded-md py-4">
          {section3.map((val, index) => {
            return (
              <div
                key={index}
                className={`flex flex-row py-4  space-x-6 justify-center ${
                  index + 1 !== section3.length && "border-r border-gray-200"
                }`}
              >
                <div className="rounded-full bg-red-100 p-3 ">
                  <img alt={val.lable} src={val.icon} className="w-6 h-6" />
                </div>
                <div>
                  <div>{val.total}</div>
                  <div>{val.lable}</div>
                </div>
              </div>
            );
          })}
        </div>
        <div className="container max-w-5xl mx-auto grid grid-cols-2 py-24  items-center ">
          <img src={Ilustration2} alt={"features-lasles-vpn"} />
          <div className="px-16 space-y-4 ">
          {tentang ? (
          tentang.map(item => (
          <div key={item.id}>
          <div className="font-medium text-3xl">{item.name}</div>
        <div className="text-sm font-normal">{item.description}</div>
        </div>
  ))
) : (<div>Tidak ada data tentang yang tersedia.</div>)}

            {features.map((val, index) => {
              return (
                <div className="flex items-center space-x-3" key={index}>
                  <img
                    src={Check}
                    alt="features-check-laslesvpn"
                    className="w-6 h-6"
                  />
                  <div className="text-xs">{val}</div>
                </div>
              );
            })}
          </div>
        </div>
        <div className="bg-gray-50 py-24">
          <TitleDesc
            title={"Harga"}
            desc={`Temukan Paket Harga dengan Harga Terjangkau`}
          />

          <div className=" container max-w-5xl mx-auto grid grid-cols-3 space-x-6">
            {plans.map((val, index) => {
              return (
                <CardPlan
                  key={index}
                  {...val}
                  isSelect={index + 1 === plans.length}
                />
              );
            })}
          </div>

          <div className="container max-w-5xl mx-auto py-24">
          
           {data.map(item => (
            <TitleDesc
          title={item.name} 
          desc={item.description}
          />
        ))}
            

            <img src={Global} alt={"Global"} className="my-20" />
            <div className="flex flex-row justify-center">
              {sosmed.map((val, index) => (
                <img key={index} src={val} className="w-44 h-14" alt={val} />
              ))}
            </div>
          </div>

          <Review />
        </div>
        <div className="bg-gray-100">
          <SubscribeNow />
        </div>
      </main>

    </div>
  );
}

export default App;
