function hodiny()
{
  const today = new Date();
  let h = getHours();
  let m = getMinutes();
  let s = getSeconds();
  m=checkTime(m);
  s=checkTime(s);
  document.getElementById("zobrazitHodiny").innerHTML = h + ":"+ m +":"+ s;
  setTimeout(hodiny,1000);
}

function checkTime(i)
{
  if(i<10)
  {
    i="0"+i
  }
  return i;
}